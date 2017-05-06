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

  private static $initialized = false;

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

  public static function redirectTo($code, $addedArgs = array(), $anchor = null)
  {
    self::initialize();

    header('Location: '.self::getUrlFromCode($code, $addedArgs, $anchor));
    exit;
  }

  public static function redirectToSame($exceptedArgs = array(), $addedArgs = array(), $anchor = null)
  {
    self::initialize();

    header('Location: '.self::getCurrentUrl($exceptedArgs, $addedArgs, $anchor));
    exit;
  }

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

  public static function getCurrentUrl($exceptedArgs = array(), $addedArgs = array(), $anchor = null)
  {
    self::initialize();

    return Url::getCurrentUrl(null, $addedArgs, $exceptedArgs, true, $anchor);
  }

  private static function initialize()
  {
    if (!self::$initialized) {
      Url::setDefaultUrlPattern('%q%');
      self::$initialized = true;
    }
  }

}
