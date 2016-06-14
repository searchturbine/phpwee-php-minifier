<?php
namespace PHPWee\CssMin;

/**
 * Abstract definition of a CSS token class.
 *
 * Every token has to extend this class.
 *
 * @package        CssMin/Tokens
 * @link        http://code.google.com/p/cssmin/
 * @author        Joe Scylla <joe.scylla@gmail.com>
 * @copyright    2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @version        3.0.1
 */
abstract class CssToken
{
    /**
     * @var array
     */
    public $MediaTypes = array();

    /**
     * @var string
     */
    public $Property = "";

    /**
     * @var string
     */
    public $Value = "";

    /**
     * Returns the token as string.
     *
     * @return string
     */
    abstract public function __toString();
}
