<?php
namespace PHPWee\CssMin;

/**
 * This {@link CssToken CSS token} represents the start of a @media at-rule block.
 *
 * @package        CssMin/Tokens
 * @link        http://code.google.com/p/cssmin/
 * @author        Joe Scylla <joe.scylla@gmail.com>
 * @copyright    2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @version        3.0.1
 */
class CssAtMediaStartToken extends CssAtBlockStartToken
{
    /**
     * Sets the properties of the @media at-rule.
     *
     * @param array $mediaTypes Media types
     */
    public function __construct(array $mediaTypes = array())
    {
        $this->MediaTypes = $mediaTypes;
    }

    /**
     * Implements {@link CssToken::__toString()}.
     *
     * @return string
     */
    public function __toString()
    {
        return "@media ".implode(",", $this->MediaTypes)."{";
    }
}
