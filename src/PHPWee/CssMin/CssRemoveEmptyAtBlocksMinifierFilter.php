<?php
namespace PHPWee\CssMin;

/**
 * This {@link CssMinifierFilter minifier filter} will remove any empty @font-face, @keyframes, @media and @page
 * at-rule blocks.
 *
 * @package        CssMin/Minifier/Filters
 * @link        http://code.google.com/p/cssmin/
 * @author        Joe Scylla <joe.scylla@gmail.com>
 * @copyright    2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @version        3.0.1
 */
class CssRemoveEmptyAtBlocksMinifierFilter extends CssMinifierFilter
{
    /**
     * Implements {@link CssMinifierFilter::filter()}.
     *
     * @param array $tokens Array of objects of type CssToken
     * @return integer Count of added, changed or removed tokens; a return value large than 0 will rebuild the array
     */
    public function apply(array &$tokens)
    {
        $r = 0;
        for ($i = 0, $l = count($tokens); $i < $l; $i++) {
            $current = get_class($tokens[$i]);
            $next = isset($tokens[$i + 1]) ? get_class($tokens[$i + 1]) : false;
            if (($current === "CssAtFontFaceStartToken" && $next === "CssAtFontFaceEndToken") ||
                ($current === "CssAtKeyframesStartToken" && $next === "CssAtKeyframesEndToken") ||
                ($current === "CssAtPageStartToken" && $next === "CssAtPageEndToken") ||
                ($current === "CssAtMediaStartToken" && $next === "CssAtMediaEndToken")
            ) {
                $tokens[$i] = null;
                $tokens[$i + 1] = null;
                $i++;
                $r = $r + 2;
            }
        }
        return $r;
    }
}
