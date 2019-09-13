<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 14.01.16
 * Time: 00:25
 */

// https://www.notprovided.eu/area51/scraper-example.txt
// http://www.stylusstudio.com/docs/v62/d_xpath15.html

// http://php.net/manual/de/domxpath.query.php
// http://php.net/manual/de/class.domnode.php
// http://php.net/manual/de/class.domnodelist.php
// http://php.net/manual/en/domxpath.evaluate.php
// http://php.net/manual/en/class.domxpath.php
// http://php.net/manual/de/domdocument.getelementsbytagname.php
// http://stackoverflow.com/questions/10396245/php-domxpath-get-the-result
// https://gist.github.com/jmoz/2996220

ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
ini_set('max_execution_time', 120);

$file = "localhost_file.html";
$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
$doc->loadHTMLFile($file);
//$doc->Load($file);
$xpath = new DOMXpath($doc);

//$query = '//h2[contains(@class,"title")]';
$query = './/div[contains(@class,"span4 box advanced")]';
$elements = $xpath->query($query); // insert Xpath reference.
$separ = ",";
$counter = 0;

if (!is_null($elements)) {

	foreach ($elements as $element) {

		echo '"';

		foreach ($element->childNodes as $ic) {

			if (trim($ic->textContent) != "") {
				if (trim($ic->textContent) == "Email" || trim($ic->textContent) == "Website") { //
					$subdiv = $ic->childNodes->item(1);
					$ssubdiv = $subdiv->childNodes->item(0);
					if ($ssubdiv) {
						$email = $ssubdiv->getAttribute('href');
						echo $email;
						echo '"' . $separ . '"';
					}
				} else {
					echo $ic->textContent;
					echo '"' . $separ . '"';
				}
			}
		}

		echo '"';
		echo "<br>";
		//die();

	}

}