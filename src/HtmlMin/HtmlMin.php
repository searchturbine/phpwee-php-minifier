<?php
	// -- Class Name : HtmlMin
	// -- Purpose : PHP class to minify html code.
	// -- Usage:  echo HtmlMin::minify($myhtml)
	// -- notes:  aply data-no-min to a style or script node to exempt it
	// -- HTML 4, XHTML, and HTML 5 compliant
	
	class HtmlMin{
			// -- Function Name : minify - Params : $html, $js = true, $css = true
		public static function minify($html, $js = true, $css = true){
			$doc = new DOMDocument();
			$doc->preserveWhiteSpace = false;
			@$doc->loadHTML($html);
			$xpath = new DOMXPath($doc);
			foreach ($xpath->query('//comment()') as $comment) {
				$val= $comment->nodeValue;
				if( strpos($val,'[')!==0){
					$comment->parentNode->removeChild($comment);
				}
			}
			$doc->normalizeDocument();
			$textnodes = $xpath->query('//text()');
			$skip = ["style","pre","code","script","textarea"];
			foreach($textnodes as $t){
				$xp = $t->getNodePath();
				$doskip = false;
				foreach($skip as $pattern){
					if(strpos($xp,"/$pattern")!==false){
						$doskip = true;
						break;
					}
				}
				if($doskip){
					continue;
				}
				$t->nodeValue = preg_replace("/\s{2,}/", " ", $t->nodeValue);
			}
			$doc->normalizeDocument();
			$divnodes = $xpath->query('//div|//p|//nav|//footer|//article|//script|//hr|//br');
			foreach($divnodes as $d){
				$candidates = [];
				if(count($d->childNodes)){
					$candidates[] = $d->firstChild;
					$candidates[] = $d->lastChild;
					$candidates[] = $d->previousSibling;
					$candidates[] = $d->nextSibling;
				}
				foreach($candidates as $c){
					if($c==null){
						continue;
					}
					if($c->nodeType==3){
						$c->nodeValue = trim($c->nodeValue);
					}
				}
			}
			$doc->normalizeDocument();
			if($js){
				$scriptnodes = $xpath->query('//script');
				foreach($scriptnodes as $d){
					if($d->hasAttribute("type") && strtolower($d->getAttribute("type"))!=='text/javascript' ){
						continue;
					}
					if($d->hasAttribute("data-no-min")){
						continue;
					}
					if(trim($d->nodeValue)==""){
						continue;
					}
					$d->nodeValue =  JSMin::minify( $d->nodeValue);
				}
			}
			if($css){
				$cssnodes = $xpath->query('//style');
				foreach($cssnodes as $d){
					if($d->hasAttribute("data-no-min")){
						continue;
					}
					if(trim($d->nodeValue)==""){
						continue;
					}
					$d->nodeValue = CssMin::minify( $d->nodeValue);
				}
			}
			return ($doc->saveHTML());
		}
	}