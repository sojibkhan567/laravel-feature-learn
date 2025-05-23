<?php

// app/Media/PublicCollectionPathGenerator.php
namespace App\Media;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class PublicCollectionPathGenerator implements PathGenerator
{
  public function getPath(Media $media): string
  {
    return $media->collection_name . '/';
  }

  public function getPathForConversions(Media $media): string
  {
    return $media->collection_name . '/conversions/';
  }

  public function getPathForResponsiveImages(Media $media): string
  {
    return $media->collection_name . '/responsive-images/';
  }
}
