<?php

kirby()->user() && kirby()->user()->role()->isAdmin() || exit();

$mjml = '<mjml>
  <mj-body>
    <mj-section>
      <mj-column>
        <mj-text>
          Hello World!
        </mj-text>
      </mj-column>
    </mj-section>
  </mj-body>
</mjml>';

$command = 'echo ' . escapeshellarg($mjml) . ' | mjml -i';

$output = shell_exec($command);

if ($output === null) {
    throw new Exception('MJML failed to execute');
}

echo '<pre>';
echo htmlspecialchars($output);
echo '</pre>';
