<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Context;

use Jin2\WebApp\Template\TemplateManager;

class Output
{

  /**
   * Variables to send to the view
   *
   * @var array
   */
  protected static $vars = array();

  /**
   * Add a new template through the TemplateManager
   *
   * @param string $templateCode
   */
  public static function addTemplate($templateCode)
  {
    TemplateManager::addTemplate($templateCode);
  }

  /**
   * Define a new variable
   *
   * @param string $key    Variable's name
   * @param string $value  Variable's value
   *
   * @todo Check if $value cannot be an array
   */
  public static function set($key, $value)
  {
    self::$vars[$key] = $value;
  }

  /**
   * Add content to an existing variable
   *
   * @param string $key    Variable's name
   * @param string $value  Value to add
   */
  public static function addTo($key, $value)
  {
    if (isset(self::$vars[$key])) {
      self::$vars[$key] .= $value;
    } else {
      self::$vars[$key] = $value;
    }
  }

  /**
   * Get a variable's content
   *
   * @param  string  $key                      Variable's name
   * @param  boolean $nullIfUndefined          (optional) Return null if undefined (default: TRUE)
   * @param  string  $defaultValueIfUndefined  (optional) Return a specified value if undefined
   * @return void
   */
  public static function get($key, $nullIfUndefined = true, $defaultValueIfUndefined = null)
  {
    if (!isset(self::$vars[$key])) {
      if ($nullIfUndefined) {
        if ($defaultValueIfUndefined) {
          return $defaultValueIfUndefined;
        }
        return null;
      } else {
        throw new \Exception('Valeur '.$key.' non définie');
      }
    } else {
      return self::$vars[$key];
    }
  }

  /**
   * Return all defined variables
   *
   * @return array Defined variables
   */
  public static function getAllVars()
  {
    return self::$vars;
  }

}
