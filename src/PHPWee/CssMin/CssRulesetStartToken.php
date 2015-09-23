<?php
namespace PHPWee\CssMin;

/**
 * This {@link CssToken CSS token} represents the start of a ruleset.
 *
 * @package        CssMin/Tokens
 * @link        http://code.google.com/p/cssmin/
 * @author        Joe Scylla <joe.scylla@gmail.com>
 * @copyright    2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @version        3.0.1
 */
class CssRulesetStartToken extends CssToken
{
    /**
     * Array of selectors.
     *
     * @var array
     */
    public $Selectors = array();

    /**
     * Set the properties of a ruleset token.
     *
     * @param array $selectors Selectors of the ruleset
     */
    public function __construct(array $selectors = array())
    {
        $this->Selectors = $selectors;
    }

    /**
     * Implements {@link CssToken::__toString()}.
     *
     * @return string
     */
    public function __toString()
    {
        return implode(",", $this->Selectors)."{";
    }
}
