<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Context;

use Jin2\WebApp\WebApp;
use Jin2\WebApp\Template\TemplateManager;
use Jin2\Utils\StringTools;

class Page
{

  /**
   * Page controller
   *
   * @var DefaultController
   */
  public $controller;

  /**
   * Page view
   *
   * @var View
   */
  public $view;

  /**
   * Method used (POST, GET...)
   *
   * @var string
   */
  protected $method;

  /**
   * Url code used
   *
   * @var string
   */
  protected $code;

  /**
   * Constructor
   *
   * @param string $code    Code to use
   * @param string $method  Method to use
   */
  public function __construct($code, $method)
  {
    if (StringTools::right($code, 1) == '/') {
      $code = StringTools::left($code, StringTools::len($code) - 1);
    }
    if (StringTools::left($code, 1) == '/') {
      $code = StringTools::right($code, StringTools::len($code) - 1);
    }

    $this->code = $code;
    $this->method = $method;
    $this->setController();
    $this->setView();
  }

  /**
   * Return the current code
   *
   * @example With the request "POST /user/login HTTP/1.0", the code will be user/login
   *
   * @return string  Current code
   */
  public function getCode()
  {
    return $this->code;
  }

  /**
   * Return the current namespace
   *
   * @example With the request "POST /user/login HTTP/1.0", the namespace will be user_login
   *
   * @return string  Current namespace
   */
  public function getNamespace()
  {
    return StringTools::replaceAll($this->getCode(), '/', '_');
  }

  /**
   * Return the current method (GET, POST...)
   *
   * @return string  Current method
   */
  public function getMethod()
  {
    return $this->method;
  }

  /**
   * Set the current controller, searching for it in various places.
   *
   * @example
   * With the request "POST /user/login HTTP/1.0", WebApp will search for the following files :
   * - user/login/controller/POST/user_login_controller.php  (search for method-related controller)
   * - user/login/controller/GET/user_login_controller.php   (fallback on GET controller)
   * - user/login/controller/user_login_controller.php       (fallback on global controller)
   * - user/login/user_login_controller.php                  (fallback on root controller)
   */
  protected function setController()
  {
    $controller = null;
    if (is_file($this->getRootPath() . 'controller/' . $this->getMethod() . '/' . $this->getNameSpace() . '_controller.php')) {
      $controller = $this->getRootPath() . 'controller/' . $this->getMethod() . '/' . $this->getNameSpace() . '_controller.php';
    } else if (is_file($this->getRootPath() . 'controller/GET/' . $this->getNameSpace() . '_controller.php')) {
      $controller = $this->getRootPath() . 'controller/GET/' . $this->getNameSpace() . '_controller.php';
    } else if (is_file($this->getRootPath() . 'controller/' . $this->getNameSpace() . '_controller.php')) {
      $controller = $this->getRootPath() . 'controller/' . $this->getNameSpace() . '_controller.php';
    } else if (is_file($this->getRootPath() . '' . $this->getNameSpace() . '_controller.php')) {
      $controller = $this->getRootPath() . '' . $this->getNameSpace() . '_controller.php';
    }

    if ($controller) {
      include $controller;
      $classPath = '\\' . $this->getNameSpace() . '_controller';
      $this->controller = new $classPath();
    } else {
      $this->controller = new DefaultController();
    }
  }

  /**
   * Set the current view, searching for it in various places.
   *
   * @example
   * With the request "POST /user/login HTTP/1.0", WebApp will search for the following files :
   * - user/login/view/POST/view.php  (search for method-related view)
   * - user/login/view/GET/view.php   (fallback on GET view)
   * - user/login/view/view.php       (fallback on global view)
   * - user/login/view.php            (fallback on root view)
   * - user/login/index.php           (fallback on root index file)
   */
  protected function setView()
  {
    if (is_file($this->getRootPath() . 'view/' . $this->getMethod() . '/view.php')) {
      $this->view = new View($this->getRootPath() . 'view/' . $this->getMethod() . '/view.php');
    } else if (is_file($this->getRootPath() . 'view/GET/view.php')) {
      $this->view = new View($this->getRootPath() . 'view/GET/view.php');
    } else if (is_file($this->getRootPath() . 'view/view.php')) {
      $this->view = new View($this->getRootPath() . 'view/view.php');
    } else if (is_file($this->getRootPath() . 'view.php')) {
      $this->view = new View($this->getRootPath() . 'view.php');
    } else if (is_file($this->getRootPath() . 'index.php')) {
      $this->view = new View($this->getRootPath() . 'index.php');
    } else {
      throw new \Exception('Vue introuvable pour la page ' . $this->code);
    }
  }

  /**
   * Return the page root path, based on WebApp root path and the curent code
   *
   * @return string  Page root path
   */
  public function getRootPath()
  {
    $folder = WebApp::getPageFolder() . $this->code;
    if (StringTools::right($folder, 1) != '/') {
      $folder .= '/';
    }
    return $folder;
  }

  /**
   * Trigger actions when the page is initialized
   */
  public function onInit()
  {
    $this->controller->onInit();
  }

  /**
   * Trigger actions when the a POST request was made
   */
  public function onPost()
  {
    if (!empty($_POST)) {
      $this->controller->onPost($_POST);
    }
  }

  /**
   * Trigger actions before the page rendering
   */
  public function beforeRender()
  {
    $this->controller->beforeRender();
  }

  /**
   * Render the page
   */
  public function render()
  {
    $baseContent = $this->view->executeAndReturnContent();
    $content = TemplateManager::render($baseContent);
    $content = $this->controller->render($content);
    return $content;
  }

  /**
   * Trigger actions after the page rendering
   */
  public function afterRender()
  {
    $this->controller->afterRender();
  }

}
