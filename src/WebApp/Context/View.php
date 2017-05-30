<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Context;

use Jin2\WebApp\WebApp;

class View
{

  /**
   * View file
   *
   * @var string
   */
  protected $file;

  /**
   * Contructor
   *
   * @param string $file  View file location
   */
  public function __construct($file)
  {
    $this->file = $file;
  }

  /**
   * Return the view file location
   *
   * @return string
   */
  public function getFile()
  {
    return $this->file;
  }

  /**
   * Return the view content
   *
   * @return string
   */
  public function executeAndReturnContent()
  {
    ob_start();
    Output::$controller = WebApp::$page->controller;
    include $this->file;
    $content = ob_get_contents();
    ob_clean();

    return $content;
  }

}
