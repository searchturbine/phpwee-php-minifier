<?php
namespace PHPWee\CssMin;

use PHPWee\JsMin\JsMin;

/**
 * This {@link CssMinifierPlugin} compress the content of expresssion() declaration values.
 *
 * For compression of expressions {@link https://github.com/rgrove/jsmin-php/ JSMin} will get used. JSMin have to be
 * already included or loadable via {@link http://goo.gl/JrW54 PHP autoloading}.
 *
 * @package        CssMin/Minifier/Plugins
 * @link        http://code.google.com/p/cssmin/
 * @author        Joe Scylla <joe.scylla@gmail.com>
 * @copyright    2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @version        3.0.1
 */
class CssCompressExpressionValuesMinifierPlugin extends CssMinifierPlugin
{
    /**
     * Implements {@link CssMinifierPlugin::minify()}.
     *
     * @param CssToken $token Token to process
     * @return boolean Return TRUE to break the processing of this token; FALSE to continue
     */
    public function apply(CssToken &$token)
    {
        if (class_exists("JSMin") && stripos($token->Value, "expression(") !== false) {
            $value = substr($token->Value, stripos($token->Value, "expression(") + 10);
            $value = trim(JsMin::minify($value));
            $token->Value = "expression(".$value.")";
        }
        return false;
    }

    /**
     * Implements {@link aMinifierPlugin::getTriggerTokens()}
     *
     * @return array
     */
    public function getTriggerTokens()
    {
        return array
        (
            "CssAtFontFaceDeclarationToken",
            "CssAtPageDeclarationToken",
            "CssRulesetDeclarationToken"
        );
    }
}
