<?php

function assetV(string $path)
{
    $asset = asset($path);
    return $asset->url() . '?v=' . $asset->mediaHash();
}
