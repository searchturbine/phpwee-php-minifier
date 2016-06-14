<?php
namespace PHPWee\CssMin;

/**
 * This {@link CssToken CSS token} represents the start of a @variables at-rule block.
 *
 * @package        CssMin/Tokens
 * @link        http://code.google.com/p/cssmin/
 * @author        Joe Scylla <joe.scylla@gmail.com>
 * @copyright    2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @version        3.0.1
 */
class CssAtVariablesStartToken extends CssAtBlockStartToken
{
    /**
     * Media types of the @variables at-rule block.
     *
     * @var array
     */
    public $MediaTypes = array();

    /**
     * Set the properties of a @variables at-rule token.
     *
     * @param array $mediaTypes Media types
     */
    public function __construct($mediaTypes = null)
    {
        $this->MediaTypes = $mediaTypes ? $mediaTypes : array("all");
    }

    /**
     * Implements {@link CssToken::__toString()}.
     *
     * @return string
     */
    public function __toString()
    {
        return "";
    }
}
