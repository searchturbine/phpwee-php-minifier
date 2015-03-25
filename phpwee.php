<?
require_once("src/CssMin/CssMin.php");
require_once("src/HtmlMin/HtmlMin.php");
require_once("src/JsMin/JsMin.php");
 	
// -- Class Name : HtmlMin
// -- Purpose : PHP class to minify html code.
// -- Usage:  echo HtmlMin::minify($myhtml)
// -- notes:  aply data-no-min to a style or script node to exempt it
// -- HTML 4, XHTML, and HTML 5 compliant

class PHPWee{
	
	public static function minifyHTML($html){
		return HtmlMin::minify($html);
	}
	
	public static function minifyCSS($css){
		return CssMin::minify($css);
	}
	
	public static function minifyJS($js){
		return JsMin::minify($js);
	}
	
}
	
