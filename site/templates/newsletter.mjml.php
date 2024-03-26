<?php

/**
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\App $kirby
 */

use Kirby\Toolkit\Str;

$kirby->user() && $kirby->user()->role()->isAdmin() || exit();

$blocks = $page->text()->toBlocks();

$fontsCss = $kirby->url('assets') . '/email/fonts.css';
$logoUrl = $kirby->url('assets') . '/email/logo.png';

function sdbColor(string $name): string
{
    $colors = [
        'blue' => '#07397E',
        'violet' => '#3c00bd',
        'sky' => '#017fa7',
        'red' => '#c00000',
        'brown' => '#730347',
        'teal' => '#006067',
    ];
    return $colors[$name];
}

// TODO: load Inter?

// TODO: <mj-preview>?

$mjml = '<mjml>
  <mj-head>
    <mj-font name="RecoletaMedium" href="' . $fontsCss . '" />

    <mj-attributes>
      <mj-divider border-color="#DDE3EE" border-width="1px" padding="0 16px" />
      <mj-text font-family="Inter, Helvetica, Arial, sans-serif" font-size="17px" line-height="28px" padding="0 16px 10px 16px" />
      <mj-image padding="10px 16px 20px 16px" border-radius="8px" />
      <mj-class name="h2" font-family="RecoletaMedium, \'Publico Text\', Georgia, serif" font-size="30px" line-height="33px" align="center" font-weight="600" padding-top="60px" padding-bottom="30px" />
      <mj-class name="h3" font-weight="600" font-size="18px" padding-top="30px" />
      <mj-social font-family="Inter, Helvetica, Arial, sans-serif" font-size="14px" line-height="28px" font-weight="600"
                icon-size="16px" mode="horizontal" align="left" padding="5px 16px 10px 16px" inner-padding="0 0 0 8px" text-padding="0 8px 0 6px" css-class="sources" />
      <mj-social-element border-radius="2px" css-class="pill" />
    </mj-attributes>
    
    <mj-style inline="inline">
      a {
        color: #000000;
        text-decoration: underline;
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

$lastSubsectionBlockId = null;

$mjml .= '<mj-section><mj-column>';
foreach ($blocks as $block) {
    if ($block->type() === 'newsletter-section') {
        $mjml .= '<mj-text mj-class="h2" color="' . sdbColor($block->color()) . '"><span id="' . $block->text()->slug() . '">' . $block->text() . '</span></mj-text>';
    } else if ($block->type() === 'newsletter-subsection') {
        $mjml .= '<mj-text mj-class="h3">• ' . $block->text() . '</mj-text>';
        $lastSubsectionBlockId = $block->id();
    } else if ($block->type() === 'text') {
        $text = $block->text();
        // Replace <p> with <mj-text>
        $text = preg_replace('/<p>(.*?)<\/p>/', '<mj-text>$1</mj-text>', $text);
        $mjml .= $text;
    } else if ($block->type() == 'list') {
        $text = $block->text();
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
              ' . $block->text() . '
            </mj-text>
    
            <mj-text align="center" font-size="14px" padding-bottom="0">
                ' . $block->citation() . '
            </mj-text>
          </mj-column>
        </mj-section><mj-section><mj-column>';
    } else if ($block->type() == 'newsletter-sources') {
        $mjml .= '<mj-social>';
        $mjml .= '<mj-social-element src="' . asset('assets/like.svg')->url() . '" href="' . $page->url() . '/like/' . $lastSubsectionBlockId . '">Mi piace</mj-social-element>';
        foreach ($block->sources()->toStructure() as $source) {
            // TODO: need permalink
            $asset = asset('assets/sources/' . urlToIconFileName($source->url()))->resize(16 * 2, 16 * 2)->url();
            $mjml .= '<mj-social-element src="' . $asset . '" href="' . $source->url() . '">' . $source->name() . '</mj-social-element>';
        }
        $mjml .= '</mj-social>';
    }
}

$mjml .= '
<mj-divider padding="60px 16px"></mj-divider>

<mj-text>
Se questa newsletter ti è piacuta, inoltrala a un amico o a un collega. Se non sei già iscritto, <a href="' . $kirby->url() . '" target="_blank">puoi farlo qui</a>.
</mj-text>

<mj-text>
Se vuoi dirmi qualcosa, rispondi pure a questa email.
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

die($output);

echo '<pre>';
echo htmlspecialchars($output);
echo '</pre>';
