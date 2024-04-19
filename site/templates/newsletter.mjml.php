<?php

/**
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\App $kirby
 */

use Kirby\Toolkit\Str;

$kirby->user() && $kirby->user()->role()->isAdmin() || exit();

$blocks = $page->text()->toBlocks();

$logoUrl = $kirby->url('assets') . '/email/logo.png';

// TODO: <mj-preview>?

$mjml = '<mjml>
  <mj-head>
    <mj-attributes>
      <mj-divider border-color="#F0F2F5" border-width="2px" padding="0 16px" />
      <mj-text font-family="Georgia, ui-serif, Cambria, \'Times New Roman\', Times, serif" font-size="19px" line-height="1.5" padding="0 16px 10px 16px" />
      <mj-image padding="10px 16px 20px 16px" border-radius="8px" />
      <mj-class name="h2" font-family="Inter, Helvetica, Arial, sans-serif" font-size="30px" line-height="1.1" font-weight="600" padding-top="0" padding-bottom="20px" />
      <mj-class name="header" font-family="Inter, Helvetica, Arial, sans-serif" font-size="14px" font-weight="700" letter-spacing="0.025em" padding="0 16px 16px 16px" />
      <mj-class name="number" font-family="Inter, Helvetica, Arial, sans-serif" align="left" background-color="#A731D1" border-radius="40px"
                width="40px" height="40px" padding="0px 16px 20px 16px" inner-padding="0" font-size="16px" font-weight="600" />
      <mj-social font-family="Inter, Helvetica, Arial, sans-serif" font-size="14px" line-height="28px" font-weight="600"
                icon-size="16px" mode="horizontal" align="left" padding="10px 16px 10px 16px" inner-padding="0 0 0 8px" text-padding="0 8px 0 6px" css-class="sources" />
      <mj-social-element border-radius="2px" css-class="pill" />
    </mj-attributes>
    
    <mj-style inline="inline">
      a {
        color: #000000;
        text-decoration: underline;
      }
      b, strong {
        font-weight: 600;
      }
      .pill {
        background-color: #F0F2F5;
      }
      .sources > table {
        margin: 0 6px 6px 0;
      }
    </mj-style>
  </mj-head>
  
  <mj-body width="640px">
    <mj-section>
      <mj-column>
        <mj-image width="200px" src="' . $logoUrl . '" padding-top="35px"></mj-image>

        <mj-divider padding="40px 16px 20px 16px"></mj-divider>
      </mj-column>
    </mj-section>
';

$subscribeBlockCount = 0;
$number = 0;

$mjml .= '<mj-section><mj-column>';
foreach ($blocks as $block) {
    if ($block->type() === 'newsletter-v2-section-header') {
        $number++;
        $mjml .= '<mj-text mj-class="header">' . $block->text()->upper()->smartypants() . '</mj-text>';
        $mjml .= '<mj-button mj-class="number">' . $number . '</mj-button>';
    } else if ($block->type() === 'newsletter-v2-section-title') {
        $mjml .= '<mj-text mj-class="h2"><span id="' . $block->text()->slug() . '">' . $block->text()->smartypants() . '</span></mj-text>';
    } else if ($block->type() === 'text') {
        $text = $block->text()->smartypants();
        // Replace <p> with <mj-text>
        $text = preg_replace('/<p>(.*?)<\/p>/', '<mj-text>$1</mj-text>', $text);
        $mjml .= $text;
    } else if ($block->type() == 'list') {
        $text = $block->text()->smartypants();
        // Replace <li> with <mj-text>
        $text = preg_replace('/<li>(.*?)<\/li>/', '<mj-text>• $1</mj-text>', $text);
        // Remove <ul> and </ul>
        $text = preg_replace('/<ul>(.*?)<\/ul>/', '$1', $text);
        $mjml .= $text;
    } else if ($block->type() === 'image') {
        $file = $block->image()->toFile();
        $link = $block->link()->isNotEmpty()
            ? Str::esc($block->link()->toUrl())
            : $page->url() . '/image/' . $file->uuid()->id() . '/full';
        $src = $page->url() . '/image/' . $file->uuid()->id() . '/preview';
        $mjml .= '<mj-image src="' . $src . '" alt="" href="' . $link . '"></mj-image>';
    } else if ($block->type() === 'quote') {
        $mjml .= '</mj-column></mj-section><mj-section padding="0 16px 10px 16px">
          <mj-column background-color="#f5f5f5" padding="20px">
            <mj-text font-family="Georgia, serif" align="center" font-size="24px" line-height="32px">
              ' . $block->text()->smartypants() . '
            </mj-text>
    
            <mj-text align="center" font-size="14px" padding-bottom="0">
                ' . $block->citation()->smartypants() . '
            </mj-text>
          </mj-column>
        </mj-section><mj-section><mj-column>';
    } else if ($block->type() == 'newsletter-sources') {
        $mjml .= '<mj-social>';
        foreach ($block->sources()->toStructure() as $source) {
            $iconImage = $kirby->url('assets') . '/email/sources/' . urlToIconFileName($source->url()); // this is a route
            $mjml .= '<mj-social-element src="' . $iconImage . '" href="' . $source->url() . '">' . $source->name() . '</mj-social-element>';
        }
        $mjml .= '</mj-social>';
    } else if ($block->type() == 'newsletter-subscribe') {
        if ($subscribeBlockCount === 0) {
            $mjml .= '<mj-text padding="30px 16px 10px 16px" font-style="italic">
                Questa email è molto lunga e in base all’app che stai usando potrebbe essere tagliata verso la fine. Se preferisci, <a href="' . $page->url() . '" target="_blank">puoi leggerla online</a>.
                </mj-text>
                <mj-text padding="0 16px 20px 16px" font-style="italic">
                Se ti piace, inoltrala a un amico o a un collega. Potrà iscriversi <a href="' . $kirby->url() . '" target="_blank">qua</a>.
            </mj-text>';
        }
        $subscribeBlockCount++;
    } else if ($block->type() == 'line') {
        $mjml .= '<mj-divider padding="20px 16px"></mj-divider>';
    }
}

$mjml .= '
<mj-divider padding="60px 16px"></mj-divider>

<mj-text>
Se questa newsletter ti è piacuta, inoltrala a un amico o a un collega. <a href="' . $kirby->url() . '" target="_blank">Potrà iscriversi qua</a>.
</mj-text>

<mj-text>
Se vuoi dirmi qualcosa, rispondi pure a questa email!
</mj-text>

<mj-text>
Ciao,<br>Matteo
</mj-text>

<mj-divider padding="40px 16px 60px 16px"></mj-divider>

<mj-text font-size="14px" color="#5A6B88" align="center">
<a href="{{UnsubscribeURL}}" target="_blank">Disiscriviti</a>
</mj-text>

<mj-text font-size="12px" color="#5A6B88" line-height="18px" align="center">
© CC BY 4.0
<br>
Inviata con <a href="{{RewardsURL}}">EmailOctopus</a>
<br>
{{SenderInfoLine}}
</mj-text>

<mj-spacer height="50px"></mj-spacer>

</mj-column>
</mj-section>
</mj-body>
</mjml>';

$command = 'echo ' . escapeshellarg($mjml) . ' | mjml -i';

$output = shell_exec($command);

if ($output === null) {
    throw new Exception('MJML failed to execute');
}

echo $output;
