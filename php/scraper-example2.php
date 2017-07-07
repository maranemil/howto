<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 14.01.16
 * Time: 00:26
 */

// http://simplehtmldom.sourceforge.net/
// http://simplehtmldom.sourceforge.net/manual_faq.htm
// https://davidwalsh.name/php-notifications
// https://github.com/sunra/php-simple-html-dom-parser
// https://github.com/jjanyan/Simple-HTML-DOM

if( ini_get('allow_url_fopen') ) {
	//echo "allo url fopen is OK";
}
else {
	//echo "allo url fopen is NOT OK";
}

include 'simplehtmldom/simple_html_dom.php';

//$link = "http://simplehtmldom.sourceforge.net/";
$link = "http://localhost/localhost_file.html";

//$html = file_get_html($link);
//$html = file_get_html($link)->plaintext;

/*
// Using Curl
//-------------------------------------
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
$str = curl_exec($curl);
curl_close($curl);
$str = str_replace("\n"," ",$str);
echo '<textarea cols="120" rows="7">'.$str."</textarea>";
$html= str_get_html($str);

// Using file_get_contents
//-------------------------------------
if($source = file_get_contents($link))
{
	$html = str_get_html($source);
	//echo $html->plaintext;
}
*/

$html = file_get_html($link);

foreach($html->find('div.span4') as $content){
	//echo $content->outertext . '<br>';
	if (!empty($content)) {
		echo @$content->find('h2.title',0)->plaintext; echo "<br>";
		echo @$content->find('div.location',0)->plaintext; echo "<br>";
		echo @$content->find('div.phone',0)->plaintext; echo "<br>";
		echo @$content->find('div.email > a',0)->href; echo "<br>";
		echo @$content->find('a.website',0)->href; echo "<br>";
		echo "<hr>";
	}
	//die();
}

$html->clear();
unset($html);






