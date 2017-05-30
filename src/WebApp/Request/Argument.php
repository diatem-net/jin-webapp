<?php

/**
 * Jin Framework
 * Diatem
 */

namespace Jin2\WebApp\Request;

class Argument
{

  /**
   * Argument name
   *
   * @var sring
   */
  protected $name;

  /**
   * Argument type
   *
   * @var string
   */
  protected $type;

  /**
   * Argument value
   *
   * @var string
   */
  protected $value;

  /**
   * Contructor
   *
   * @param string $name   Argument name
   * @param string $type   Argument type
   * @param string $value  Argument value
   */
  public function __construct($name, $type, $value)
  {
    $this->name = $name;
    $this->type = $type;
    $this->value = $value;
  }

  /**
   * Return the argument name
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Return the argument type
   *
   * @return string
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * Return the argument value
   *
   * @return string
   */
  public function getValue()
  {
    return $this->value;
  }

  /**
   * Set the argument value
   *
   * @param string $value  Argument value
   */
  public function setValue($value)
  {
    $this->value = $value;
  }

}
