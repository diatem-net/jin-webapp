<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Utils;

use Jin2\WebApp\WebApp;
use Jin2\WebApp\Context\Url;
use Jin2\Utils\StringTools;

class Navigation
{

  /**
   * Flag to check if the Navigation was initialized
   *
   * @var boolean
   */
  protected static $initialized = false;

  /**
   * Initialize the navigation class
   */
  protected static function initialize()
  {
    if (!self::$initialized) {
      Url::setDefaultUrlPattern('%q%');
      self::$initialized = true;
    }
  }

  /**
   * Clean the Url code
   *
   * @param  string $code  Url code
   * @return string
   */
  public static function clearQueryArg($code)
  {
    if (StringTools::left($code, 1) == '/') {
      $code = StringTools::right($code, StringTools::len($code)-1);
    }
    if (StringTools::right($code, 1) == '/') {
      $code = StringTools::left($code, StringTools::len($code)-1);
    }

    return $code;
  }

  /**
   * Redirect to another page
   *
   * @param  string $code       Url code
   * @param  array  $addedArgs  (optional) Additional arguments
   * @param  string $anchor     (optional) Anchor
   */
  public static function redirectTo($code, $addedArgs = array(), $anchor = null)
  {
    self::initialize();

    header('Location: '.self::getUrlFromCode($code, $addedArgs, $anchor));
    exit;
  }

  /**
   * Redirect to the same page
   *
   * @param  array  $exceptedArgs  (optional) Arguments to remove during the redirection
   * @param  array  $addedArgs     (optional) Arguments to add during the redirection
   * @param  string $anchor        (optional) Anchor
   */
  public static function redirectToSame($exceptedArgs = array(), $addedArgs = array(), $anchor = null)
  {
    self::initialize();

    header('Location: '.self::getCurrentUrl($exceptedArgs, $addedArgs, $anchor));
    exit;
  }

  /**
   * Get a full url from an url code
   *
   * @param  string $code       Url code
   * @param  array  $addedArgs  (optional) Additional arguments
   * @param  string $anchor     (optional) Anchor
   */
  public static function getUrlFromCode($code, $addedArgs = array(), $anchor = null)
  {
    self::initialize();

    $code = self::clearQueryArg($code);

    if ($code == '_root') {
      return WebApp::url();
    }

    if (StringTools::right($code, 1) != '/') {
      $code .= '/';
    }

    $args = array('q' => $code);
    $args = array_merge($args, $addedArgs);
    return Url::getUrl(null, $args, true, $anchor);
  }

  /**
   * Return the current url
   *
   * @param  array  $exceptedArgs  (optional) Arguments to remove from the current url
   * @param  array  $addedArgs     (optional) Arguments to add to the current url
   * @param  string $anchor        (optional) Anchor
   */
  public static function getCurrentUrl($exceptedArgs = array(), $addedArgs = array(), $anchor = null)
  {
    self::initialize();

    return Url::getCurrentUrl(null, $addedArgs, $exceptedArgs, true, $anchor);
  }

}
