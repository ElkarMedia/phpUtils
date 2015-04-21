<?php
	
	function get_first_image($html){
	    require_once('simple_html_dom.php');
	    if ($html == null || trim($html) == "") {
			return "";
		}
	    $post_html = str_get_html($html);
	    $first_img = $post_html->find('img', 0);
	    if($first_img !== null) {
	        return $first_img->src;
	    }
	    return null;
	}

	function addRootToImages($text,$rootName) {
		require_once('simple_html_dom.php');
		$rootName = "/".$rootName."/";
		if ($text == null || trim($text) == "") {
			return "";
		}
		$html = str_get_html($text);
		for ($x = 0; $x < sizeof($html->find('img')); $x++) {
			$img = $html->find('img', $x);
			$img->src = "http://".$_SERVER['HTTP_HOST'].$rootName.$img->src;
		}
		return $html->save();
	}

	function extracto ( $contenido, $cantidadPalabras ) {
		$contenido = str_replace("&nbsp;","",$contenido);
		$contenido = explode(' ', $contenido);
		$tail = "";
		if (sizeof($contenido) > $cantidadPalabras) {
			$tail = "...";
		}
		$contenido = array_slice($contenido, 0, $cantidadPalabras);
		$contenido = implode(' ', $contenido);
		return trim($contenido.$tail);
	}

	function writeToFile($text) {
		if (!isset($text) || $text == null || $text == "") {
			$text = "hola ";
		}
		file_put_contents("./../logs/log.php",date('Y-m-d H:i:s')."\n".$text."\n\n" , FILE_APPEND | LOCK_EX);
	}

?>
