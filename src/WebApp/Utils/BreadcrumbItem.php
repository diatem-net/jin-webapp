<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Utils;

use Jin2\WebApp\Request\Request;

class BreadcrumbItem
{

  protected $label;
  protected $urlCode;
  protected $url;
  protected $addedArgs;

  public function __construct($label, $urlCode = null, $addedArgs = array())
  {
    $this->label = $label;
    if ($urlCode) {
      $this->urlCode = $urlCode;
      $this->url = Navigation::getUrlFromCode($urlCode, $addedArgs);
      $this->addedArgs = $addedArgs;
    }
  }

  public function isSelected()
  {
    if (Navigation::clearQueryArg(Request::getArgumentValue('q')) == Navigation::clearQueryArg($this->urlCode)) {
      return true;
    }
    return false;
  }

  public function isLinkable()
  {
    if ($this->urlCode) {
      return true;
    }
    return false;
  }

  public function getLabel()
  {
    return $this->label;
  }

  public function getCode()
  {
    return $this->urlCode;
  }

  public function getUrl()
  {
    return $this->url;
  }

}
