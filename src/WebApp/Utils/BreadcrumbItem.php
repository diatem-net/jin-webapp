<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Utils;

use Jin2\WebApp\Request\Request;

class BreadcrumbItem
{

  /**
   * Label
   *
   * @var string
   */
  protected $label;

  /**
   * Url code
   *
   * @var string
   */
  protected $urlCode;

  /**
   * Url, generated from the url code
   *
   * @var string
   */
  protected $url;

  /**
   * Additional arguments
   *
   * @var array
   */
  protected $addedArgs;

  /**
   * Contrucrot
   *
   * @param string $label     Label of the breadcrumb item
   * @param string $urlCode   (optional) Url code for the breadcrumb item
   * @param array  $addedArgs (optional) Additional arguments
   */
  public function __construct($label, $urlCode = null, $addedArgs = array())
  {
    $this->label = $label;
    if ($urlCode) {
      $this->urlCode = $urlCode;
      $this->url = Navigation::getUrlFromCode($urlCode, $addedArgs);
      $this->addedArgs = $addedArgs;
    }
  }

  /**
   * Check if the breadcrumb item match the current page
   *
   * @return boolean  TRUE if it match the current page
   */
  public function isSelected()
  {
    if (Navigation::clearQueryArg(Request::getArgumentValue('q')) == Navigation::clearQueryArg($this->urlCode)) {
      return true;
    }
    return false;
  }

  /**
   * Check if the breadcrumb item is a link
   *
   * @return boolean  TRUE if it is a link
   */
  public function isLinkable()
  {
    if ($this->urlCode) {
      return true;
    }
    return false;
  }

  /**
   * Return the breadcrumb item's label
   *
   * @return string
   */
  public function getLabel()
  {
    return $this->label;
  }

  /**
   * Return the breadcrumb item's URL code
   *
   * @return string
   */
  public function getCode()
  {
    return $this->urlCode;
  }

  /**
   * Return the breadcrumb item's URL
   *
   * @return string
   */
  public function getUrl()
  {
    return $this->url;
  }

}
