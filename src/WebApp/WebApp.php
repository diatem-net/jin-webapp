<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp;

use Jin2\WebApp\Request\Router;
use Jin2\WebApp\Request\Request;

class WebApp
{

  /**
   * Root path of the WebApp
   *
   * @var string
   */
  protected static $path;

  /**
   * Root url of the WebApp
   *
   * @var string
   */
  protected static $url;

  /**
   * Folder containing all pages
   *
   * @var string
   */
  protected static $pageFolder = 'pages';

  /**
   * Folder containing the cache
   *
   * @var string
   */
  protected static $cacheFolder = 'cache';

  /**
   * Folder containing all templates
   *
   * @var string
   */
  protected static $templateFolder = 'templates';

  /**
   * Router
   *
   * @var Jin2\WebApp\Request\Router
   */
  public static $router;

  /**
   * Current page
   *
   * @var Jin2\WebApp\Conext\Page
   */
  public static $page;

  /**
   * Constructor
   *
   * @param string $path  Root path of the WebApp
   * @param string $url   (optional) Root url of the WebApp (default: /)
   */
  public static function init($path, $url = '/')
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

  /**
   * Get the root path of the WebApp
   *
   * @return string
   */
  public static function path()
  {
    return self::$path;
  }

  /**
   * Get the root url of the WebApp
   *
   * @return string
   */
  public static function url()
  {
    return self::$url;
  }

  /**
   * Set the page folder
   *
   * @param string $folder
   */
  public static function setPageFolder($folder)
  {
    self::$pageFolder = $folder;
  }

  /**
   * Get the page folder
   *
   * @return string
   */
  public static function getPageFolder()
  {
    $folder = self::path() . self::$pageFolder;
    return rtrim(realpath($folder), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
  }

  /**
   * Get the cache folder
   *
   * @return string
   */
  public static function getCacheFolder()
  {
    $folder = self::path() . self::$cacheFolder;
    return rtrim(realpath($folder), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
  }

  /**
   * Set the cache folder
   *
   * @param string $folder
   */
  public static function setCacheFolder($folder)
  {
    self::$cacheFolder = $folder;
  }

  /**
   * Get the template folder
   *
   * @return string
   */
  public static function getTemplateFolder()
  {
    $folder = self::path() . self::$templateFolder;
    return rtrim(realpath($folder), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
  }

  /**
   * Set the template folder
   *
   * @param string $folder
   */
  public static function setTemplateFolder($folder)
  {
    self::$templateFolder = $folder;
  }

}
