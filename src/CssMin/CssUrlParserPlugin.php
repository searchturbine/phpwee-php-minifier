<?php
namespace PHPWee\CssMin;

/**
 * {@link CssParserPlugin Parser plugin} for preserve parsing url() values.
 *
 * This plugin return no {@link CssToken CssToken} but ensures that url() values will get parsed properly.
 *
 * @package        CssMin/Parser/Plugins
 * @link        http://code.google.com/p/cssmin/
 * @author        Joe Scylla <joe.scylla@gmail.com>
 * @copyright    2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @version        3.0.1
 */
class CssUrlParserPlugin extends CssParserPlugin
{
    /**
     * Implements {@link CssParserPlugin::getTriggerChars()}.
     *
     * @return array
     */
    public function getTriggerChars()
    {
        return array("(", ")");
    }

    /**
     * Implements {@link CssParserPlugin::getTriggerStates()}.
     *
     * @return array
     */
    public function getTriggerStates()
    {
        return false;
    }

    /**
     * Implements {@link CssParserPlugin::parse()}.
     *
     * @param integer $index Current index
     * @param string $char Current char
     * @param string $previousChar Previous char
     * @param $state
     * @return mixed TRUE will break the processing;
     *               FALSE continue with the next plugin;
     *               integer set a new index and break the processing
     */
    public function parse($index, $char, $previousChar, $state)
    {
        // Start of string
        if ($char === "("
            && strtolower(substr($this->parser->getSource(), $index - 3, 4)) === "url("
            && $state !== "T_URL"
        ) {
            $this->parser->pushState("T_URL");
            $this->parser->setExclusive(__CLASS__);
        } elseif ($char === "\n" && $previousChar === "\\" && $state === "T_URL") {
            // Escaped LF in url => remove escape backslash and LF
            $this->parser->setBuffer(substr($this->parser->getBuffer(), 0, -2));
        } elseif ($char === "\n" && $previousChar !== "\\" && $state === "T_URL") {
            // Parse error: Unescaped LF in string literal
            $line = $this->parser->getBuffer();
            // Replace the LF with the url string delimiter
            $this->parser->setBuffer(substr($this->parser->getBuffer(), 0, -1).")");
            $this->parser->popState();
            $this->parser->unsetExclusive();
            CssMin::triggerError(
                new CssError(
                    __FILE__,
                    __LINE__,
                    __METHOD__.": Unterminated string literal",
                    $line."_"
                )
            );
        } elseif ($char === ")" && $state === "T_URL") {
            // End of string
            $this->parser->popState();
            $this->parser->unsetExclusive();
        } else {
            return false;
        }

        return true;
    }
}
