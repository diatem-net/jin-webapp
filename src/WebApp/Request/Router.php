<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Request;

use Jin2\WebApp\WebApp;
use Jin2\WebApp\Context\Page;
use Jin2\Context\HttpHeader;

class Router
{

  protected static $rootArgumentName = 'q';

  public function __construct()
  {
    if (!Request::getArgumentValue(self::$rootArgumentName, true) || Request::getArgumentValue(self::$rootArgumentName, true) == 'index.html') {
      $this->rootToIndex();
    } else {
      if (is_dir(WebApp::getPageFolder().Request::getArgumentValue(self::$rootArgumentName))) {
        $this->rootToPage(Request::getArgumentValue(self::$rootArgumentName));
      } else {
        $this->rootTo404();
      }
    }
  }

  public static function setRootArgumentName($rootArgumentName)
  {
    self::$rootArgumentName = $rootArgumentName;
  }

  public static function getRootArgumentName()
  {
    return self::$rootArgumentName;
  }

  protected function rootToIndex()
  {
    if (is_dir(WebApp::getPageFolder().'_root/')) {
      WebApp::$page = new Page('_root', Request::getRequestMethod());
    } else {
      throw new \Exception('Page root introuvable (_root)');
    }
  }

  protected function rootTo404()
  {
    if (is_dir(WebApp::getPageFolder().'_404/')) {
      WebApp::$page = new Page('_404', Request::getRequestMethod());
    } else {
      HttpHeader::return404();
      throw new \Exception('Page 404 introuvable (_404)');
    }
  }

  protected function rootToPage($page)
  {
    WebApp::$page = new Page($page, Request::getRequestMethod());
  }

}
