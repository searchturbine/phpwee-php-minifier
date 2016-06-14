<?php
namespace PHPWee\CssMin;

/**
 * This {@link CssMinifierPlugin} will convert named color values to hexadecimal notation.
 *
 * Example:
 * <code>
 * color: black;
 * border: 1px solid indigo;
 * </code>
 *
 * Will get converted to:
 * <code>
 * color:#000;
 * border:1px solid #4b0082;
 * </code>
 *
 * @package        CssMin/Minifier/Plugins
 * @link        http://code.google.com/p/cssmin/
 * @author        Joe Scylla <joe.scylla@gmail.com>
 * @copyright    2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @version        3.0.1
 */
class CssConvertNamedColorsMinifierPlugin extends CssMinifierPlugin
{

    /**
     * Regular expression matching the value.
     *
     * @var string
     */
    private $reMatch = null;

    /**
     * Regular expression replacing the value.
     *
     * @var string
     */
    private $reReplace = "\"\${1}\" . \$this->transformation[strtolower(\"\${2}\")] . \"\${3}\"";

    /**
     * Transformation table used by the
     * {@link CssConvertNamedColorsMinifierPlugin::$reReplace replace regular expression}.
     *
     * @var array
     */
    private $transformation = array
    (
        "aliceblue" => "#f0f8ff",
        "antiquewhite" => "#faebd7",
        "aqua" => "#0ff",
        "aquamarine" => "#7fffd4",
        "azure" => "#f0ffff",
        "beige" => "#f5f5dc",
        "black" => "#000",
        "blue" => "#00f",
        "blueviolet" => "#8a2be2",
        "brown" => "#a52a2a",
        "burlywood" => "#deb887",
        "cadetblue" => "#5f9ea0",
        "chartreuse" => "#7fff00",
        "chocolate" => "#d2691e",
        "coral" => "#ff7f50",
        "cornflowerblue" => "#6495ed",
        "cornsilk" => "#fff8dc",
        "crimson" => "#dc143c",
        "darkblue" => "#00008b",
        "darkcyan" => "#008b8b",
        "darkgoldenrod" => "#b8860b",
        "darkgray" => "#a9a9a9",
        "darkgreen" => "#006400",
        "darkkhaki" => "#bdb76b",
        "darkmagenta" => "#8b008b",
        "darkolivegreen" => "#556b2f",
        "darkorange" => "#ff8c00",
        "darkorchid" => "#9932cc",
        "darkred" => "#8b0000",
        "darksalmon" => "#e9967a",
        "darkseagreen" => "#8fbc8f",
        "darkslateblue" => "#483d8b",
        "darkslategray" => "#2f4f4f",
        "darkturquoise" => "#00ced1",
        "darkviolet" => "#9400d3",
        "deeppink" => "#ff1493",
        "deepskyblue" => "#00bfff",
        "dimgray" => "#696969",
        "dodgerblue" => "#1e90ff",
        "firebrick" => "#b22222",
        "floralwhite" => "#fffaf0",
        "forestgreen" => "#228b22",
        "fuchsia" => "#f0f",
        "gainsboro" => "#dcdcdc",
        "ghostwhite" => "#f8f8ff",
        "gold" => "#ffd700",
        "goldenrod" => "#daa520",
        "gray" => "#808080",
        "green" => "#008000",
        "greenyellow" => "#adff2f",
        "honeydew" => "#f0fff0",
        "hotpink" => "#ff69b4",
        "indianred" => "#cd5c5c",
        "indigo" => "#4b0082",
        "ivory" => "#fffff0",
        "khaki" => "#f0e68c",
        "lavender" => "#e6e6fa",
        "lavenderblush" => "#fff0f5",
        "lawngreen" => "#7cfc00",
        "lemonchiffon" => "#fffacd",
        "lightblue" => "#add8e6",
        "lightcoral" => "#f08080",
        "lightcyan" => "#e0ffff",
        "lightgoldenrodyellow" => "#fafad2",
        "lightgreen" => "#90ee90",
        "lightgrey" => "#d3d3d3",
        "lightpink" => "#ffb6c1",
        "lightsalmon" => "#ffa07a",
        "lightseagreen" => "#20b2aa",
        "lightskyblue" => "#87cefa",
        "lightslategray" => "#789",
        "lightsteelblue" => "#b0c4de",
        "lightyellow" => "#ffffe0",
        "lime" => "#0f0",
        "limegreen" => "#32cd32",
        "linen" => "#faf0e6",
        "maroon" => "#800000",
        "mediumaquamarine" => "#66cdaa",
        "mediumblue" => "#0000cd",
        "mediumorchid" => "#ba55d3",
        "mediumpurple" => "#9370db",
        "mediumseagreen" => "#3cb371",
        "mediumslateblue" => "#7b68ee",
        "mediumspringgreen" => "#00fa9a",
        "mediumturquoise" => "#48d1cc",
        "mediumvioletred" => "#c71585",
        "midnightblue" => "#191970",
        "mintcream" => "#f5fffa",
        "mistyrose" => "#ffe4e1",
        "moccasin" => "#ffe4b5",
        "navajowhite" => "#ffdead",
        "navy" => "#000080",
        "oldlace" => "#fdf5e6",
        "olive" => "#808000",
        "olivedrab" => "#6b8e23",
        "orange" => "#ffa500",
        "orangered" => "#ff4500",
        "orchid" => "#da70d6",
        "palegoldenrod" => "#eee8aa",
        "palegreen" => "#98fb98",
        "paleturquoise" => "#afeeee",
        "palevioletred" => "#db7093",
        "papayawhip" => "#ffefd5",
        "peachpuff" => "#ffdab9",
        "peru" => "#cd853f",
        "pink" => "#ffc0cb",
        "plum" => "#dda0dd",
        "powderblue" => "#b0e0e6",
        "purple" => "#800080",
        "red" => "#f00",
        "rosybrown" => "#bc8f8f",
        "royalblue" => "#4169e1",
        "saddlebrown" => "#8b4513",
        "salmon" => "#fa8072",
        "sandybrown" => "#f4a460",
        "seagreen" => "#2e8b57",
        "seashell" => "#fff5ee",
        "sienna" => "#a0522d",
        "silver" => "#c0c0c0",
        "skyblue" => "#87ceeb",
        "slateblue" => "#6a5acd",
        "slategray" => "#708090",
        "snow" => "#fffafa",
        "springgreen" => "#00ff7f",
        "steelblue" => "#4682b4",
        "tan" => "#d2b48c",
        "teal" => "#008080",
        "thistle" => "#d8bfd8",
        "tomato" => "#ff6347",
        "turquoise" => "#40e0d0",
        "violet" => "#ee82ee",
        "wheat" => "#f5deb3",
        "white" => "#fff",
        "whitesmoke" => "#f5f5f5",
        "yellow" => "#ff0",
        "yellowgreen" => "#9acd32"
    );

    /**
     * Overwrites {@link CssMinifierPlugin::__construct()}.
     *
     * The constructor will create the
     * {@link CssConvertNamedColorsMinifierPlugin::$reReplace replace regular expression}
     * based on the {@link CssConvertNamedColorsMinifierPlugin::$transformation transformation table}.
     *
     * @param CssMinifier $minifier The CssMinifier object of this plugin.
     * @param array $configuration Plugin configuration [optional]
     */
    public function __construct(CssMinifier $minifier, array $configuration = array())
    {
        $this->reMatch = "/(^|\s)+(".implode("|", array_keys($this->transformation)).")(\s|$)+/eiS";
        parent::__construct($minifier, $configuration);
    }

    /**
     * Implements {@link CssMinifierPlugin::minify()}.
     *
     * @param CssToken $token Token to process
     * @return boolean Return TRUE to break the processing of this token; FALSE to continue
     */
    public function apply(CssToken &$token)
    {
        $lcValue = strtolower($token->Value);
        // Declaration value equals a value in the transformation table => simple replace
        if (isset($this->transformation[$lcValue])) {
            $token->Value = $this->transformation[$lcValue];
        } // Declaration value contains a value in the transformation table => regular expression replace
        elseif (preg_match($this->reMatch, $token->Value)) {
            $token->Value = preg_replace($this->reMatch, $this->reReplace, $token->Value);
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
