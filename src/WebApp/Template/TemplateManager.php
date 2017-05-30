<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Template;

use Jin2\WebApp\WebApp;
use Jin2\Utils\StringTools;

class TemplateManager
{

  /**
   * Templates
   *
   * @var array<Template>
   */
  protected static $templates = array();

  /**
   * Add a new template
   *
   * @param string $templateCode
   */
  public static function addTemplate($templateCode)
  {
    if (!is_dir(WebApp::getTemplateFolder().$templateCode)) {
      throw new \Exception('La template '.$templateCode.' n\'existe pas.');
    } else {
      self::$templates[] = new Template($templateCode);
    }
  }

  /**
   * Render content
   *
   * @param string $content
   */
  public static function render($content)
  {
    $temp = '#content#';
    foreach (self::$templates AS $template) {
      $temp = $template->render($temp);
    }
    $temp = StringTools::replaceAll($temp, '#content#', $content);
    return $temp;
  }

}
