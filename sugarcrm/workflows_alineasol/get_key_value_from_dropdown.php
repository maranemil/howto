<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 06.02.17
 * Time: 14:29
 */


global $sugar_config;
global $GLOBALS;
global $db;

global $app_list_strings;
include("custom/application/Ext/Language/" . $GLOBALS['current_language'] . ".lang.ext.php");

if (!empty($bean->id)) {

	$bean_id = $bean->id;
	$sqlUpQCR = "SELECT billing_address_country FROM accounts WHERE id='" . $bean_id . "' LIMIT 1";
	$resUpQCR = $db->query($sqlUpQCR);
	$rowUpQCR = $db->fetchByAssoc($resUpQCR);

	if (!empty($rowUpQCR["billing_address_country"])) {

		$accCountry = $rowUpQCR["billing_address_country"];
		$keyCountry = '';

		foreach ($app_list_strings['countries_dom'] as $key => $country) {
			//echo $country."\n";
			if (trim(strtolower($country)) == trim(strtolower($accCountry))) {
				$keyCountry = $key;
			}
		}

		/*$beanAcc = BeanFactory::retrieveBean('Accounts', $bean_id, array('disable_row_level_security' => true));
				$accCountry = $beanAcc->billing_address_country;
				#$beanAcc->pdf_quote_country_c = $beanAcc->billing_address_country;
		*/

		if (!empty($keyCountry)) {
			$accCountry = $rowUpQCR["billing_address_country"];
			$sqlUpQC = "UPDATE accounts_cstm SET country_c='" . $keyCountry . "'
			WHERE id_c = '" . $bean_id . "' LIMIT 1 ";
			$db->query($sqlUpQC);
		}
	}


}