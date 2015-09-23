<?php
namespace PHPWee;

/**
 * Class PHPWee
 * @package PHPWee
 */
class PHPWee
{
    /**
     * @param $html
     * @return string
     */
    public static function html($html)
    {
        return HtmlMin\HtmlMin::minify($html);
    }

    /**
     * @param $css
     * @return string
     */
    public static function css($css)
    {
        return CssMin\CssMin::minify($css);
    }

    /**
     * @param $js
     * @return string
     */
    public static function js($js)
    {
        return JsMin\JsMin::minify($js);
    }
}
