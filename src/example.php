<?
require_once ("PHPWee.php");

$html = file_get_contents("http://en.wikipedia.org/wiki/Minification_%28programming%29");
$minified = PHPWee::minifyHTML($html);
echo "\nWikipedia ".print_improvement($minified,$html);


$html = file_get_contents("http://www.codeproject.com/Articles/759094/Step-by-Step-PHP-Tutorials-for-Beginners-Creating");
$minified = PHPWee::minifyHTML($html);
echo "\nThe Code Project ".print_improvement($minified,$html);


$html = file_get_contents("https://github.com/php/php-src");
$minified = PHPWee::minifyHTML($html);
echo "\nGitHub ".print_improvement($minified,$html);


$html = file_get_contents("http://www.w3schools.com/php/");
$minified = PHPWee::minifyHTML($html);
echo "\nW3Schools ".print_improvement($minified,$html);
 
$html = file_get_contents("http://localhost/searchturbine.beta.com/");
$minified = PHPWee::minifyHTML($html);
echo "\nSearchTurbine.com ".print_improvement($minified,$html);
 
 




function print_improvement($minified,$html){
	$before = strlen(gzcompress($html));
	$after = strlen(gzcompress($minified));
		
$improvement =  100 * (1-($after/$before));
echo  "<table><tr><td>$before before</td><td>$after after</td><td> $improvement % faster </td></table>";
}
//echo $minified;


/*
$css = file_get_contents("http://php.net/cached.php?t=1421837618&f=/styles/home.css");


$minified = PHPWee::minifyCSS($css);

$improvement =  100 * (1-(strlen(gzcompress($minified))/strlen(gzcompress($css))));
echo "<-- $improvement % faster -->";
//echo $minified;


$js = file_get_contents("http://php.net/cached.php?t=1421837618&f=/js/common.js");

$minified = PHPWee::minifyJS($js);

$improvement =  100 * (1-(strlen(gzcompress($minified))/strlen(gzcompress($js))));
echo "<-- $improvement % faster -->";
//echo $minified;
*/