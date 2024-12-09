<?php

/*
|--------------------------------------------------------------------------
| Cache Themes
|--------------------------------------------------------------------------
|
| igaster/laravel-theme reads themes settings from json files inside
| each theme's folder. We will cache them in a single php file to
| avoid searching the filesystem for each Request. You can use
| 'theme:refresh-cache' to rebuild cache, or set config/themes.php
| 'cache' setting to false to disable completely
|
*/

return array (
  0 => 
  array (
    'name' => 'default',
    'asset-path' => 'themes/default',
    'extends' => '',
    'views-path' => 'default',
  ),
  1 => 
  array (
    'name' => 'modern',
    'asset-path' => 'themes/modern',
    'extends' => '',
    'views-path' => 'modern',
  ),
);