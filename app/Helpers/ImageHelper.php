<?php

namespace App\Helpers;
use File;

class ImageHelper {

  public static function getImageBlog($content)
  {
    $display_path = '/uploads/';
    if ($content->image) {
      $path = public_path().$display_path;
      if(File::exists($path.$content->image)) {
        return $display_path.$content->image;
      } else {
        return '/uploads/defaults/default-blog.jpg';
      }
    } else {
      return '/uploads/defaults/default-blog.jpg';
    }
  }
}