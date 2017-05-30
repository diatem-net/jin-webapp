<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Context;

class DefaultController
{

  /**
   * Contains code that will be executed on the controller's initialization
   */
  public function onInit()
  {
  }

  /**
   * Contains code that will be executed when a POST request is made
   */
  public function onPost($args)
  {
  }

  /**
   * Contains code that will be executed before the rendering
   */
  public function beforeRender()
  {
  }

  /**
   * Render content
   */
  public function render($content)
  {
    return $content;
  }

  /**
   * Contains code that will be executed after the rendering
   */
  public function afterRender()
  {
  }

}

