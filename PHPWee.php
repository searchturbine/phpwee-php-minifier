<?php
namespace PHPWee;

/**
 * Class Minify
 * @package PHPWee
 */
class Minify
{
    public static function html($html)
    {
        return HtmlMin\HtmlMin::minify($html);
    }
    
    public static function css($css)
    {
        return CssMin\CssMin::minify($css);
    }
    
    public static function js($js)
    {
        return JsMin\JsMin::minify($js);
    }
}
