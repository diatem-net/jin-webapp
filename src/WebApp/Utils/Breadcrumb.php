<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Utils;

class Breadcrumb
{

  protected static $items = array();

  public static function add($label, $urlCode = null, $addedArgs = array())
  {
    self::$items[] = new BreadcrumbItem($label, $urlCode, $addedArgs);
  }

  public static function getAllItems()
  {
    return self::$items;
  }

}
