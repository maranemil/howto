<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 08.12.15
 * Time: 14:01
 */

//---------------------------------------------------------------------
// SugarCRM: Visibility: Modify SQL
// custom__data__visibility__YourVisibilityClass.php
//---------------------------------------------------------------------

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class YourVisibilityClass extends SugarVisibility{
	protected  $bean;
	public function __construct($bean)
	{
		$this->bean = $bean;
		$this->module_dir = $this->bean->module_dir;
	}
	public function addVisibilityWhereQuery(SugarQuery $sugarQuery, $options = array())
	{
		global $current_user, $timedate;
		$aclRole = new ACLRole();
		$rolesNames = $aclRole->getUserRoleNames($current_user->id); //
		$where = null;
		//$GLOBALS['log']->fatal('Tasks_By_Day_Mobile::addVisibilityWhere:: llamando al where personalizado'.print_r($sugarQuery,true));
		if( count($rolesNames) && in_array('Salesman', $rolesNames) ){
			$meeting_dateStart = new SugarDateTime();
			$meeting_dateEnd = new SugarDateTime();
			$dateStart = $timedate->tzUser($meeting_dateStart, $current_user)->setTime('00','00','00')->asDb();
			$dateEnd = $timedate->tzUser($meeting_dateEnd, $current_user)->setTime('23','59','59')->asDb();
			$sugarQuery->where()->between('date_start', $dateStart, $dateEnd);
		}
		//$GLOBALS['log']->fatal("query ".$sugarQuery->compileSql());
		return $sugarQuery;
	}
}


// custom__Extension__modules__Tasks__Ext__Vardefs__your_module_ext_visibility.php

$dictionary['Task']['visibility'] = array(
	"YourVisibilityClass" => true,
);








//---------------------------------------------------------------------
// https://gist.github.com/betobaz/d6c2657124cee73f56e1
// SugarCRM::Data Visibility
// custom_data_visibility_OwnedByTeamField.php
//---------------------------------------------------------------------

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class OwnedByTeamField extends SugarVisibility{
	protected  $bean;
	public function __construct($bean)
	{
		$this->bean = $bean;
		$this->module_dir = $this->bean->module_dir;
	}
	public function addVisibilityWhere(&$query, $options = null){
		$GLOBALS['log']->fatal("OwnedByTeamField::addVisibilityWhere query:" . print_r($query, true));
		$query .= " AND account_type = 'Prospecto' ";
	}
	public function addSseVisibilityFilter($engine, $filter)
	{
		$GLOBALS['log']->fatal("OwnedByTeamField::addSseVisibilityFilter: filter" . print_r($filter, true));
		return $filter;
	}

	// Utilizar para aplicar clausulas para la vista de lista
	public function addVisibilityWhereQuery(SugarQuery $query)
	{
		$query->where()
			->equals('account_type', 'Prospecto');
		$GLOBALS['log']->fatal("OwnedByTeamField::addVisibilityWhereQuery: query" . print_r($query->compileSql(), true));
		return $query;
	}
}



$dictionary['Account']['visibility'] = array(
	"OwnedByTeamField" => true,
);





//---------------------------------------------------------------------
// SugarCRM Notifications like facebook
// custom_modules_Activities_ActivitiesLogicHookCustom.php
// https://gist.github.com/betobaz/d3557ed54afb8851d285
// custom_modules_Activities_ActivitiesLogicHookCustom.php
//---------------------------------------------------------------------

class ActivitiesLogicHookCustom{
	public function notifyActivity($bean, $event, $arguments){
		if($bean->module_name == 'Activities'){
			global $current_user;
			$data = json_decode($bean->data);
			$message = preg_replace('/(\@)\[\w+\:[a-f0-9-]{36}\:([\w ]+)\]/u', '$1$2', $data->value);
			foreach($data->tags as $tag){
				if($tag->module == 'Users'){
					$notification = BeanFactory::newBean('Notifications');
					$notification->name = $current_user->user_name . ' mentioned you in an activity';
					$notification->description = $message;
					$notification->assigned_user_id = $tag->id;
					$notification->save();
				}
			}
		}
	}
}


// custom_modules_logic_hooks.php

$hook_version = 1;
$hook_array = Array();
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1,'Notify activity','custom/modules/Activities/ActivitiesLogicHookCustom.php','ActivitiesLogicHookCustom','notifyActivity',);











//---------------------------------------------------------------------
// Sugarcrm::add layout and view
// custom_modules_Accounts_clients_base_layouts_rnfm_rnfm.php
// https://gist.github.com/betobaz/a1f26ace29cb0d3cab58
//---------------------------------------------------------------------


$viewdefs['Accounts']['base']['layout']['nrfm'] = array(
	'type' => 'simple',
	'components' => array(
		array(
			'view' => 'nrfm',
		),
	),
);

/*
custom_modules_Accounts_clients_base_views_rnfm_rnfm.hbs
<h1>Hola mundo</h1>



custom_modules_Accounts_clients_base_views_rnfm_rnfm.js
({
     className: 'nrfm',
       loadData: function (options) {
           this.render();
           console.log("Estas dentro");
       }
   })
*/





//---------------------------------------------------------------------
// https://gist.github.com/betobaz/f2e706fd50054a43ed98
// sugarquery_join_custom_module.php
// SugarCRM::SugarQuery:: Join with custom module
//---------------------------------------------------------------------

$sugarQuery = new SugarQuery();
$sugarQuery->select(array('id', 'name', 'precio'));
$precioBean = BeanFactory::newBean('MXC06_Precio');
$sugarQuery->from($precioBean);
$sugarQuery->join('mxc06_precio_accounts');
$sugarQuery->join('mxc06_precio_producttemplates');
$sugarQuery->where()
	->equals('mxc06_precio_accountsaccounts_ida', $pedido->cmx03_pedidos_accountsaccounts_ida)
	->equals('mxc06_precio_producttemplatesproducttemplates_ida', $bean->cmx03_detallespedido_producttemplatesproducttemplates_ida);
$GLOBALS['log']->debug("QuoteLogicHook::getPrecio query:" . print_r($sugarQuery->compileSql(), true) );
$result = $sugarQuery->execute();




//---------------------------------------------------------------------
// https://gist.github.com/betobaz/10001231
// User Custom Api
// custom_clients_base_api_UserCustomApi.php
//---------------------------------------------------------------------

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'include/api/SugarApi.php';
class UserCustomApi extends SugarApi
{
	public function registerApiRest()
	{
		return array(
			'retrive_by_emails' => array(
				'reqType' => 'GET',
				'path' => array('Users','filter','email',),
				'pathVars' => array(),
				'method' => 'retriveUsersByEmailAddress',
				'shortHelp' => 'Retrieve Users by email addresses',
				'longHelp' => '',
			),
		);
	}

	public function retriveUsersByEmailAddress($api, $args)
	{
		$users = array();
		//$users['args'] = $args;
		$emailAddresses = explode(",",preg_replace('/[\[\]\"]/', '', $args['email_addresses']));
		$email = BeanFactory::getBean('EmailAddresses');
		$q = $email->getEmailsQuery('Users');
		$q->joinRaw("JOIN users ON users.deleted = 0 and users.id = ear.bean_id", array('alias' => 'users'));
		$q->where()
			->in("email_addresses.email_address", $emailAddresses)
			->equals("ear.primary_address", "1");
		$q->select->field("ear.bean_id");
		$q->select->fieldRaw("users.user_name");
		$email_rows = $q->execute();
		$users['users'] = $email_rows;
		return $users;
	}
}



//---------------------------------------------------------------------
// Notifica por correo y consumiendo un api
// https://gist.github.com/betobaz/5767179
//---------------------------------------------------------------------

class CasesLogicHook{
	protected $urlApiNotifications = 'http://node.test.dev/api/notifications';
	protected $notificaciones = array(
		'Assigned' => array(
			'id_template' => '26735934-183c-4f76-3e97-50984ae40813',
			'message' => "El caso con número {case_number} ha sido asignado para su precesamiento.",
		),
		'Liberado_desarrollo' => array(
			'id_template' => '48a0056f-8ce2-23b1-00eb-509c39916b1e',
			'message' => "El caso con número {case_number} ha sido liberado por parte de desarrollo.",
		),
		'Liberado_ABPRO' => array(
			'id_template' => '91531a14-4477-8186-ba18-509c3b919c97',
			'message' => "El caso con número {case_number} ha sido liberado, requiere de su aprobación.	",
		),
		'Rejected' => array(
			'id_template' => 'c07950c4-af31-0c58-2735-51ae77f1ece2',
			'message' => "El caso con número {case_number} No Procede.	",
		),
	);
	private $patronVariablesTemplate = '/(\{::)(future|pass)(::)(\w+)(::)(\w+)((::)(\w+))?(::\})/';
	public function cargaPreData(SugarBean $bean, $event, $arguments){
		$GLOBALS['log']->debug("AbproCases cargaPreData entrando");
		$bean->acPreData = $bean->fetched_row;
	}
	public function notifica(SugarBean $bean, $event, $arguments){
		global $sugar_config;
		$fetchedRow = $bean->acPreData;
		$GLOBALS['log']->debug("AbproCases notifica bean->status: " . print_r($bean->status, true));
		$GLOBALS['log']->debug("AbproCases notifica fetchedRow: " . print_r($fetchedRow, true));
		if($bean->status !== $fetchedRow['status'] && in_array($bean->status, array_keys($this->notificaciones))){
			$bean->load_relationship('contacts');
			$contacts = $bean->contacts->getBeans();
			$emailAddresses = array();
			if(count($contacts)){
				$GLOBALS['log']->debug("AbproCases notifica sugar_config: " . print_r($sugar_config, true));
				$emailAddresses = $this->getEmailAddresses($contacts);
				$GLOBALS['log']->debug("AbproCases notifica emailAddresses: " . print_r($emailAddresses, true));
				$this->sendEmail($bean, $emailAddresses, $this->notificaciones[$bean->status]);
				// Envio de notificaciones a la pagina de casos
				$message = urlencode($this->notificaciones[$bean->status]);
				//$message = urlencode($this->notificaciones[$bean->status]);
				//$message = str_replace("{case_number}", $bean->case_number, $this->notificaciones[$bean->status]);
				$message = str_replace("{case_number}", $bean->case_number, $this->notificaciones[$bean->status]['message']);
				foreach($contacts as $contact){
					$this->addNotification(array(
						'message' => $message,
						'contact_id' => $contact->id,
						'case_id' => $bean->id,
					));
				}
			}
		}
	}
	public function getEmailAddresses($contacts){
		$emailAddresses = array();
		foreach($contacts as $contact){
			$emailAddresses[] = $contact->email1;
		}
		return $emailAddresses;
	}
	public function sendEmail($bean, $emailAddresses, $notificacionData){
		//Busqueda del email template
		require_once("modules/EmailTemplates/EmailTemplate.php");
		$emailTemp = new EmailTemplate();
		$emailTemp->disable_row_level_security = true;
		//TODO crear el campo id_email_template
		$GLOBALS['log']->debug("AbproCases sendEmail notificacionData: " . print_r($notificacionData, true));
		$emailTemp->retrieve($notificacionData['id_template']);
		require_once("include/SugarPHPMailer.php");
		$mail = new SugarPHPMailer();
		require_once("modules/Emails/Email.php");
		$emailObj = new Email();
		$defaults = $emailObj->getSystemDefaultEmail();
		$mail->From = $defaults['email'];
		$mail->FromName = $defaults['name'];
		$GLOBALS['log']->debug("AbproCases sendEmail emailTemp->body_html: " . from_html($emailTemp->body_html), true);
		$mail->Subject = $this->renderTextWithBean($bean, $emailTemp->subject);
		$emailTemp->body_html = $this->renderTextWithBean($bean, $emailTemp->body_html);
		if ($emailTemp->text_only != 1)
		{
			$mail->IsHTML(true);
			$mail->Body = from_html($emailTemp->body_html);
			$mail->AltBody = from_html($emailTemp->body);
		}
		else
		{
			$mail->Body_html = from_html($emailTemp->body_html, 900);
			$mail->Body = from_html($emailTemp->body);
		}
		//$mail->prepForOutboud();
		$mail->setMailerForSystem();
		$GLOBALS['log']->debug("Cases sendEmail mail: " . print_r($mail, true));
		foreach($emailAddresses as $emailAddress){
			$mail->ClearAllRecipients();
			$GLOBALS['log']->debug('Cases sendEmail enviando correo a: ' . print_r($emailAddress, true));
			$mail->AddAddress($emailAddress, $emailAddress);
			if( !$mail->Send() ){
				$GLOBALS['log']->fatal('ERROR[Cases]: Message Send Failed');
			}
		}
	}
	private function renderTextWithBean($bean, $text){
		$GLOBALS['log']->debug("Cases renderTextWithBean bean: " . print_r($bean, true));
		$coincidencias = null;
		preg_match_all($this->patronVariablesTemplate, $text, $coincidencias,PREG_SET_ORDER);
		$sustituciones = array();
		$GLOBALS['log']->debug("AbproCases renderTextWithBean text: " . $text);
		$GLOBALS['log']->debug("AbproCases renderTextWithBean coincidencias: " . print_r($coincidencias,true));
		foreach($coincidencias as $coincidencia){
			if($coincidencia[4] === $bean->module_dir){
				$value = null;
				if( !empty($coincidencia[7]) ){
					$relationship = $coincidencia[6];
					$field_name = $coincidencia[9];
					$GLOBALS['log']->debug("AbproCases renderTextWithBean relationship: " . $relationship);
					$GLOBALS['log']->debug("AbproCases renderTextWithBean field_name: " . $field_name);
					if(!$bean->$relationship){
						$bean->load_relationships($relationship);
					}
					$beansRelationship = $bean->$relationship->getBeans(new SugarBean());
					if(count($beansRelationship)){
						$value = $beansRelationship[0]->$field_name;
					}
				}else{
					if($coincidencia[2] === 'future'){
						$field_name = $coincidencia[6];
						//$value = $bean->$field_name;
						$value = $this->getTextValueField($bean, $field_name);
						$GLOBALS['log']->debug("AbproCases renderTextWithBean field_name: " . $field_name);
						$GLOBALS['log']->debug("AbproCases renderTextWithBean bean->field_name: " . $bean->$field_name);
					}else{
						$value = $bean->acPreData[$coincidencia[6]];
					}
				}
				$sustituciones[$coincidencia[0]] = $value;
			}
		}
		return str_replace(array_keys($sustituciones), array_values($sustituciones), $text);
	}
	private function completeDataBean($bean){
		global  $beanList, $beanFiles;
		$class_name = $beanList[$bean->module_dir];
		require_once($beanFiles[$class_name]);
		$seed = new $class_name();
		$seed->retrieve($bean->id);
		$GLOBALS['log']->debug("AbproCases completeDataBean class_name: " . $class_name);
		switch($bean->module_dir){
			case 'Cases':
				$GLOBALS['log']->debug("AbproCases completeDataBean seed->case_number: " . $seed->case_number);
				$bean->case_number = $seed->case_number;
				break;
		}
	}
	private function getTextValueField($bean, $field_name){
		$value = "";
		//default_language
		global $sugar_config;
		switch ($bean->field_name_map[$field_name]['type']) {
			case 'datetime':
			case 'datetimecombo':
				global $timedate;
				$dateFormat = $sugar_config['default_date_format'];
				$timeFormat = $sugar_config['default_time_format'];
				$fecha = new DateTime();
				$fecha->setTimestamp($timedate->asUserTs(new Datetime($bean->$field_name)));
				$value = $fecha->format($dateFormat . " " . $timeFormat);
				break;
			case 'date':
				global $timedate;
				//$user_date_time_format = $timedate->get_date_timemat();
				$dateFormat = $sugar_config['default_date_format'];
				$value = Datetime ($dateFormat, $bean->$field_name);
				break;
			case 'enum':
				global $app_list_strings;
				//$user_date_time_format = $timedate->get_date_time_format();
				$value = $app_list_strings[$bean->field_name_map[$field_name]['options']][$bean->$field_name];
				break;
			default:
				$value = iconv("UTF-8","ISO-8859-1", $bean->$field_name);
				break;
		}
		return $value;
	}
	private function addNotification($data){
		$GLOBALS['log']->debug("AbproCases addNotification data: " . print_r($data, true));
		$fields_string = "";
		foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $this->urlApiNotifications);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		$result = curl_exec($ch);
		$GLOBALS['log']->debug("AbproCases addNotification result curl: " . print_r($result, true));
		curl_close($ch);
	}
	public function generaFolio(SugarBean $bean, $event, $arguments){
		$preType = $bean->type ? strtoupper(substr($bean->type, 0, 3)) : "";
		//if(!$bean->id){
		$bean->folio_c =  $preType . $bean->case_number;
		//}
	}

	public function generaFechaResolucion(SugarBean $bean, $event, $arguments){
		if($bean->fetched_row['status'] !== $bean->status && ($bean->status === "Liberado_ABPRO" || $bean->status === "Rejected") || $bean->status === "Cancelado_cliente"){
			global $timedate;
			/* The new_date is 28 days from now */
			$bean->fecha_resolucion_c = null;
			$bean->fecha_resolucion_c = TimeDate::getInstance()->getNow(true)->asDb();
		}
	}
}




//---------------------------------------------------------------------
// SugarCRM CE logic hook para el envio de notificaciones
// https://gist.github.com/betobaz/5730896
//---------------------------------------------------------------------

class AbproCases{
	protected $urlApiNotifications = 'http://node.abpro.dev/api/notifications';
	protected $notificaciones = array(
		'Assigned' => array(
			'id_template' => '26735934-183c-4f76-3e97-50984ae40813',
			'message' => "El caso con nÃºmero {case_number} ha sido asignado para su precesamiento.",
		),
		'Liberado_desarrollo' => array(
			'id_template' => '48a0056f-8ce2-23b1-00eb-509c39916b1e',
			'message' => "El caso con nÃºmero {case_number} ha sido liberado por parte de desarrollo.",
		),
		'Liberado_ABPRO' => array(
			'id_template' => '91531a14-4477-8186-ba18-509c3b919c97',
			'message' => "El caso con nÃºmero {case_number} ha sido liberado, requiere de su aprobaciÃ³n.	",
		),
		'Rejected' => array(
			'id_template' => 'c07950c4-af31-0c58-2735-51ae77f1ece2',
			'message' => "El caso con nÃºmero {case_number} No Procede.	",
		),
	);
	private $patronVariablesTemplate = '/(\{::)(future|pass)(::)(\w+)(::)(\w+)((::)(\w+))?(::\})/';
	public function cargaPreData(SugarBean $bean, $event, $arguments){
		$GLOBALS['log']->debug("AbproCases cargaPreData entrando");
		$bean->acPreData = $bean->fetched_row;
	}
	public function notificaLiberadoAbpro(SugarBean $bean, $event, $arguments){
		global $sugar_config;
		$fetchedRow = $bean->acPreData;
		$GLOBALS['log']->debug("AbproCases notificaLiberadoAbpro bean->status: " . print_r($bean->status, true));
		$GLOBALS['log']->debug("AbproCases notificaLiberadoAbpro fetchedRow: " . print_r($fetchedRow, true));
		if($bean->status !== $fetchedRow['status'] && in_array($bean->status, array_keys($this->notificaciones))){
			$bean->load_relationship('contacts');
			$contacts = $bean->contacts->getBeans();
			$emailAddresses = array();
			if(count($contacts)){
				$GLOBALS['log']->debug("AbproCases notificaLiberadoAbpro sugar_config: " . print_r($sugar_config, true));
				$emailAddresses = $this->getEmailAddresses($contacts);
				$GLOBALS['log']->debug("AbproCases notificaLiberadoAbpro emailAddresses: " . print_r($emailAddresses, true));
				$this->sendEmail($bean, $emailAddresses, $this->notificaciones[$bean->status]);
				// Envio de notificaciones a la pagina de casos
				$message = urlencode($this->notificaciones[$bean->status]);
				//$message = urlencode($this->notificaciones[$bean->status]);
				//$message = str_replace("{case_number}", $bean->case_number, $this->notificaciones[$bean->status]);
				$message = str_replace("{case_number}", $bean->case_number, $this->notificaciones[$bean->status]['message']);
				foreach($contacts as $contact){
					$this->addNotification(array(
						'message' => $message,
						'contact_id' => $contact->id,
						'case_id' => $bean->id,
					));
				}
			}
		}
	}
	public function getEmailAddresses($contacts){
		$emailAddresses = array();
		foreach($contacts as $contact){
			$emailAddresses[] = $contact->email1;
		}
		return $emailAddresses;
	}
	public function sendEmail($bean, $emailAddresses, $notificacionData){
		//Busqueda del email template
		require_once("modules/EmailTemplates/EmailTemplate.php");
		$emailTemp = new EmailTemplate();
		$emailTemp->disable_row_level_security = true;
		//TODO crear el campo id_email_template
		$GLOBALS['log']->debug("AbproCases sendEmail notificacionData: " . print_r($notificacionData, true));
		$emailTemp->retrieve($notificacionData['id_template']);
		require_once("include/SugarPHPMailer.php");
		$mail = new SugarPHPMailer();
		require_once("modules/Emails/Email.php");
		$emailObj = new Email();
		$defaults = $emailObj->getSystemDefaultEmail();
		$mail->From = $defaults['email'];
		$mail->FromName = $defaults['name'];
		$GLOBALS['log']->debug("AbproCases sendEmail emailTemp->body_html: " . from_html($emailTemp->body_html), true);
		$mail->Subject = $this->renderTextWithBean($bean, $emailTemp->subject);
		$emailTemp->body_html = $this->renderTextWithBean($bean, $emailTemp->body_html);
		if ($emailTemp->text_only != 1)
		{
			$mail->IsHTML(true);
			$mail->Body = from_html($emailTemp->body_html);
			$mail->AltBody = from_html($emailTemp->body);
		}
		else
		{
			$mail->Body_html = from_html($emailTemp->body_html, 900);
			$mail->Body = from_html($emailTemp->body);
		}
		//$mail->prepForOutboud();
		$mail->setMailerForSystem();
		$GLOBALS['log']->debug("AbproCases sendEmail mail: " . print_r($mail, true));
		foreach($emailAddresses as $emailAddress){
			$mail->ClearAllRecipients();
			$GLOBALS['log']->debug('AbproCases sendEmail enviando correo a: ' . print_r($emailAddress, true));
			$mail->AddAddress($emailAddress, $emailAddress);
			if( !$mail->Send() ){
				$GLOBALS['log']->fatal('ERROR[AbproCases]: Message Send Failed');
			}
		}
	}
	private function renderTextWithBean($bean, $text){
		$GLOBALS['log']->debug("AbproCases renderTextWithBean bean: " . print_r($bean, true));
		$coincidencias = null;
		preg_match_all($this->patronVariablesTemplate, $text, $coincidencias,PREG_SET_ORDER);
		$sustituciones = array();
		$GLOBALS['log']->debug("AbproCases renderTextWithBean text: " . $text);
		$GLOBALS['log']->debug("AbproCases renderTextWithBean coincidencias: " . print_r($coincidencias,true));
		foreach($coincidencias as $coincidencia){
			if($coincidencia[4] === $bean->module_dir){
				$value = null;
				if( !empty($coincidencia[7]) ){
					$relationship = $coincidencia[6];
					$field_name = $coincidencia[9];
					$GLOBALS['log']->debug("AbproCases renderTextWithBean relationship: " . $relationship);
					$GLOBALS['log']->debug("AbproCases renderTextWithBean field_name: " . $field_name);
					if(!$bean->$relationship){
						$bean->load_relationships($relationship);
					}
					$beansRelationship = $bean->$relationship->getBeans(new SugarBean());
					if(count($beansRelationship)){
						$value = $beansRelationship[0]->$field_name;
					}
				}else{
					if($coincidencia[2] === 'future'){
						$field_name = $coincidencia[6];
						//$value = $bean->$field_name;
						$value = $this->getTextValueField($bean, $field_name);
						$GLOBALS['log']->debug("AbproCases renderTextWithBean field_name: " . $field_name);
						$GLOBALS['log']->debug("AbproCases renderTextWithBean bean->field_name: " . $bean->$field_name);
					}else{
						$value = $bean->acPreData[$coincidencia[6]];
					}
				}
				$sustituciones[$coincidencia[0]] = $value;
			}
		}
		return str_replace(array_keys($sustituciones), array_values($sustituciones), $text);
	}
	private function completeDataBean($bean){
		global  $beanList, $beanFiles;
		$class_name = $beanList[$bean->module_dir];
		require_once($beanFiles[$class_name]);
		$seed = new $class_name();
		$seed->retrieve($bean->id);
		$GLOBALS['log']->debug("AbproCases completeDataBean class_name: " . $class_name);
		switch($bean->module_dir){
			case 'Cases':
				$GLOBALS['log']->debug("AbproCases completeDataBean seed->case_number: " . $seed->case_number);
				$bean->case_number = $seed->case_number;
				break;
		}
	}
	private function getTextValueField($bean, $field_name){
		$value = "";
		//default_language
		global $sugar_config;
		switch ($bean->field_name_map[$field_name]['type']) {
			case 'datetime':
			case 'datetimecombo':
				global $timedate;
				$dateFormat = $sugar_config['default_date_format'];
				$timeFormat = $sugar_config['default_time_format'];
				$fecha = new DateTime();
				$fecha->setTimestamp($timedate->asUserTs(new Datetime($bean->$field_name)));
				$value = $fecha->format($dateFormat . " " . $timeFormat);
				break;
			case 'date':
				global $timedate;
				//$user_date_time_format = $timedate->get_date_timemat();
				$dateFormat = $sugar_config['default_date_format'];
				$value = Datetime ($dateFormat, $bean->$field_name);
				break;
			case 'enum':
				global $app_list_strings;
				//$user_date_time_format = $timedate->get_date_time_format();
				$value = $app_list_strings[$bean->field_name_map[$field_name]['options']][$bean->$field_name];
				break;
			default:
				$value = iconv("UTF-8","ISO-8859-1", $bean->$field_name);
				break;
		}
		return $value;
	}
	private function addNotification($data){
		$GLOBALS['log']->debug("AbproCases addNotification data: " . print_r($data, true));
		$fields_string = "";
		foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $this->urlApiNotifications);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		$result = curl_exec($ch);
		$GLOBALS['log']->debug("AbproCases addNotification result curl: " . print_r($result, true));
		curl_close($ch);
	}
	public function generaFolio(SugarBean $bean, $event, $arguments){
		$preType = $bean->type ? strtoupper(substr($bean->type, 0, 3)) : "";
		//if(!$bean->id){
		$bean->folio_c =  $preType . $bean->case_number;
		//}
	}

	public function generaFechaResolucion(SugarBean $bean, $event, $arguments){
		if($bean->fetched_row['status'] !== $bean->status && ($bean->status === "Liberado_ABPRO" || $bean->status === "Rejected") || $bean->status === "Cancelado_cliente"){
			global $timedate;
			/* The new_date is 28 days from now */
			$bean->fecha_resolucion_c = null;
			$bean->fecha_resolucion_c = TimeDate::getInstance()->getNow(true)->asDb();
		}
	}
}





//---------------------------------------------------------------------
// contacts_birthday_job.php
// https://gist.github.com/betobaz/5719477
//---------------------------------------------------------------------

array_push($job_strings, 'contacts_birthday_job');
function contacts_birthday_job(){
	clearContactsBirthday();
	$GLOBALS['log']->debug('JOB::contacts_birthday_job:start');
	setBirthday();
	return true;
}
function clearContactsBirthday(){
	global $db;
	$GLOBALS['log']->debug('JOB::contacts_birthday_job::clearContactsBirthday');
	$query = "update contacts_cstm
                set birthday_today_c = 0
                where birthday_today_c = 1";
	require_once("modules/Contacts/Contact.php");
	$res = $db->query($query);
	while($row = $db->fetchByAssoc($res)){
		$focus = new Contact();
		$focus->retrieve($row['id']);
		$focus->birthday_today_c = 0;
		$focus->save();
	}
}
function setBirthday(){
	global $db;
	$mesDia = TimeDate::getInstance()->getNow(true)->format('m-d');
	$query = "select id from contacts where DATE_FORMAT(birthdate, '%m-%d') = '$mesDia' and deleted = 0";
	require_once("modules/Contacts/Contact.php");
	$res = $db->query($query);
	while($row = $db->fetchByAssoc($res)){
		$focus = new Contact();
		$focus->retrieve($row['id']);
		$GLOBALS['log']->debug('JOB::contacts_birthday_job:: El contacto ' . $focus->first_name. ' Cumple anios');
		$GLOBALS['log']->debug('JOB::contacts_birthday_job:: El contacto ' . $focus->id );
		$focus->birthday_today_c = 1;
		$focus->save();
	}
}




//---------------------------------------------------------------------
// Sugarcrm:EditView modify pre display
// https://gist.github.com/betobaz/4128589
//---------------------------------------------------------------------

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once('include/MVC/View/views/view.edit.php');
class CustomViewEdit extends ViewEdit {
	var $ev;
	var $type ='edit';
	var $useForSubpanel = false;  //boolean variable to determine whether view can be used for subpanel creates
	var $useModuleQuickCreateTemplate = false; //boolean variable to determine whether or not SubpanelQuickCreate has a separate display function
	var $showTitle = true;

	function CustomViewEdit(){
		parent::ViewEdit();
		$this->useForSubpanel = TRUE;
	}

	function display(){

		echo 'test this code is displaying in quick create';    //dummy content -- code to be removed

		$this->ev->process();
		if($this->ev->isDuplicate) {
			foreach($this->ev->fieldDefs as $name=>$defs) {
				if(!empty($defs['auto_increment'])) {
					$this->ev->fieldDefs[$name]['value'] = '';
				}
			}
		}
		echo $this->ev->display($this->showTitle);
	}
}


// view.edit.php

require_once('include/MVC/View/views/view.detail.php');

class ProductsViewEdit extends ViewEdit {

	function ProductsViewEdit(){
		parent::ViewEdit();
		$this->useForSubpanel = true;
	}

	function display(){
		//echo "hola mundo";
		$this->ev->process();
		if($this->ev->isDuplicate) {
			foreach($this->ev->fieldDefs as $name=>$defs) {
				if(!empty($defs['auto_increment'])) {
					$this->ev->fieldDefs[$name]['value'] = '';
				}
			}
		}
		echo print_r($_POST, true);
		if(
			(isset($_POST['relate_to']) && $_POST['relate_to'] === 'products_products_1' && isset($_POST['relate_id'])) ||
			(isset($_POST['parent_type']) && $_POST['parent_type'] === 'Products' && isset($_POST['parent_id']))
		){
			$productId = isset($_POST['relate_id']) ? $_POST['relate_id'] : $_POST['parent_id'];
			$product = new Product();

			$product->retrieve($productId);

			$this->ev->fieldDefs['familia_c']['value'] = $product->familia_c;
			$this->ev->fieldDefs['account_name']['value'] = $product->account_name;
			$this->ev->fieldDefs['account_id']['value'] = $product->account_id;

		}

		echo $this->ev->display($this->showTitle);
	}

}
