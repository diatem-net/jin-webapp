<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp;

use Jin2\WebApp\Request\Router;
use Jin2\WebApp\Request\Request;
use Jin2\Utils\StringTools;

class WebApp
{

  protected static $path;
  protected static $url;

  protected static $pageFolder = 'pages';
  protected static $templateFolder = 'templates';
  protected static $cacheFolder = 'cache';

  public static $router;
  public static $page;

  public static function init($path, $url = DIRECTORY_SEPARATOR)
  {
    self::$path = rtrim(realpath($path), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    self::$url = $url;
    self::$router = new Router();

    self::$page->onInit();
    self::$page->onPost();
    self::$page->beforeRender();
    print self::$page->render();
    self::$page->afterRender();
  }

  public static function path()
  {
    return self::$path;
  }

  public static function url()
  {
    return self::$url;
  }

  public static function getPagesFolder()
  {
    $folder = self::path() . self::$pageFolder;
    return rtrim(realpath($folder), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
  }

  public static function getCacheFolder()
  {
    $folder = self::path() . self::$cacheFolder;
    return rtrim(realpath($folder), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
  }

  public static function getTemplateFolder()
  {
    $folder = self::path() . self::$templateFolder;
    return rtrim(realpath($folder), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
  }

}
