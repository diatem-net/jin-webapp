<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Utils;

class Breadcrumb
{

  /**
   * Breadcrumb items
   *
   * @var array<BreadcrumbItem>
   */
  protected static $items = array();

  /**
   * Add a new item to the breadcrumb
   *
   * @param string $label     Label of the breadcrumb item
   * @param string $urlCode   (optional) Url code for the breadcrumb item
   * @param array  $addedArgs (optional) Additional arguments
   */
  public static function add($label, $urlCode = null, $addedArgs = array())
  {
    self::$items[] = new BreadcrumbItem($label, $urlCode, $addedArgs);
  }

  /**
   * Return all breadcrumb items
   */
  public static function getAllItems()
  {
    return self::$items;
  }

}
