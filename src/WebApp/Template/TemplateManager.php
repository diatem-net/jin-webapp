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

  protected static $templates = array();

  public static function addTemplate($templateCode)
  {
    if (!is_dir(WebApp::getTemplateFolder().$templateCode)) {
      throw new \Exception('La template '.$templateCode.' n\'existe pas.');
    } else {
      self::$templates[] = new Template($templateCode);
    }
  }

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
