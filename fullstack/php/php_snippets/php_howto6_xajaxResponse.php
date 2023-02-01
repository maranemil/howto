/*
https://hotexamples.com/de/examples/-/xajaxResponse/addScript/php-xajaxresponse-addscript-method-examples.html
https://hotexamples.com/de/examples/-/xajaxResponse/-/php-xajaxresponse-class-examples.html
*/

function RFGetCitysByCid($country, $attr = array())
{
    $objResponse = new xajaxResponse();
    if (!$attr) {
        $attr = array('name' => 'pf_city', 'class' => 'b-select__select');
    }
    $sAttr = '';
    foreach ($attr as $key => $val) {
        $sAttr .= ' ' . $key . '="' . $val . '"';
    }
    if ($country) {
        $cities = city::GetCities(country::getCountryIDByTranslit($country));
    }
    $objResponse->script('$("b-select__city").set("html","");');
    $objResponse->script('new Element("option", { value: "0", text: "Все города" }).inject($("b-select__city"));');
    $js = '';
    if ($cities) {
        foreach ($cities as $cityid => $city) {
            $js .= 'new Element("option", { value: "' . translit(strtolower($city)) . '", text: "' . $city . '" }).inject($("b-select__city"));' . "\n";
        }
    }
    if ($js) {
        $objResponse->script($js);
    }
    return $objResponse;
}

function testForm($formData)
{
    $objResponse = new xajaxResponse();
    $objResponse->alert("formData: " . print_r($formData, true));
    $objResponse->assign("submittedDiv", "innerHTML", nl2br(print_r($formData, true)));
    return $objResponse;
}

function confirm($seconds)
{
     sleep($seconds);
     $objResponse = new xajaxResponse();
     $objResponse->append('outputDIV', 'innerHTML', '<br />confirmation from theFrame.php call');
     return $objResponse;
}

function removeHandler($sId, $sHandler)
{
    $objResponse = new xajaxResponse();
    $objResponse->removeHandler($sId, "click", $sHandler);
    $objResponse->append('log', 'innerHTML', "{$sHandler} disabled.<br />");
    return $objResponse;
}

function load_main()
{
    $objResponse = new xajaxResponse();
    $text .= gen_main();
    $objResponse->assign("site_wrapper", "innerHTML", $text);
    return $objResponse;
}

function eventHandlerThree()
{
	$objResponse = new xajaxResponse();
	$objResponse->append('log', 'innerHTML', 'Message from event handler three.<br />');
	$objResponse->setReturnValue('return value from event handler three.');
	return $objResponse;
}

function abrirNavFotos($id)
{
     $objResponse = new xajaxResponse();
     $codigo = '';
     $objResponse->addScript("xajax_loadNavFotos(" . $id . ")");
     $objResponse->addScript("desplegarDiv()");
     return $objResponse;
}

function ajax_refreshCart()
{
	$objResponse = new xajaxResponse();
	$objResponse->clear("cart-contents", "innerHTML");
	$objResponse->append("cart-contents", "innerHTML", $this->getCartTemplate());
	return $objResponse;
}

function logout()
{
     $objResponse = new xajaxResponse();
     session_destroy();
     $objResponse->script("location.reload();");
     return $objResponse;
}

function myFunction()
{
    $objResponse = new xajaxResponse();
    //$objResponse->setCharEncoding("windows-1251");
    $objResponse->addAssign("SomeElementId", "innerHTML", 'тест');
    return $objResponse;
}

function testXajaxResponse()
{
    // Return a xajax response object
    $objResponse = new xajaxResponse();
    $objResponse->assign('DataDiv', 'innerHTML', 'Xajax Response Data');
    return $objResponse;
}

function load_footer()
{
    $objResponse = new xajaxResponse();
    $text .= gen_footer();
    $objResponse->assign("bottom_nav", "innerHTML", $text);
    return $objResponse;
}

function test()
{
    $objResponse = new xajaxResponse();
    $objResponse->alert("hallo");
    $objResponse->assign('testButton', 'label', 'Success!');
    return $objResponse;
}

function select_customer($id)
{
    $JSResponse = new xajaxResponse();
    $nodes_location = LMSDB::getInstance()->GetAll('SELECT n.id, n.name, location FROM vnodes n WHERE ownerid = ? ORDER BY n.name ASC', array($id));
    $JSResponse->call('update_nodes_location', (array) $nodes_location);
    return $JSResponse;
}

function sendConfirmCommands()
{
     $objResponse = new xajaxResponse();
     $objResponse->confirmCommands(1, 'Do you want to see an alert next?');
     $objResponse->alert("Here is the alert!");
     return $objResponse;
}

function showNextHelp($nextpage)
{
    $res = new xajaxResponse();
    $iframe = "<iframe src=\"help/" . $nextpage . "\" name=\"helpIframe\">Your Browser doesn't support iframes</iframe>";
    $res->addAssign("contentView", "innerHTML", $iframe);
    return $res;
}

function removeInput($aInputData)
{
    $sId = $aInputData['inputId'];
    $objResponse = new xajaxResponse();
    $objResponse->addRemove($sId);
    return $objResponse->getXML();
}

function callScript()
{
    $response = new xajaxResponse();
    $value2 = "this is a string";
    $response->addScriptCall("myJSFunction", "arg1", 9432.120000000001, array("myKey" => "some value", "key2" => $value2));
    return $response;
}

function ws_delete($window_name, $form = '')
{
    global $base, $include, $conf, $self, $onadb;
    // Check permissions
    if (!(auth('host_del') or auth('subnet_del'))) {
        $response = new xajaxResponse();
        $response->addScript("alert('Permission denied!');");
        return $response->getXML();
    }
    // If an array in a string was provided, build the array and store it in $form
    $form = parse_options_string($form);
    // Instantiate the xajaxResponse object
    $response = new xajaxResponse();
    $js = '';
    // Run the module
    list($status, $output) = run_module('tag_del', array('tag' => $form['id'], 'commit' => 'Y'));
    // If the module returned an error code display a popup warning
    if ($status) {
        $js .= "alert('Delete failed. " . preg_replace('/[\\s\']+/', ' ', $self['error']) . "');";
    } else {
        // If there's (refresh) js, send it to the browser
        if ($form['js']) {
            $js .= $form['js'];
        }
    }
    // Return an XML response
    $response->addScript($js);
    return $response->getXML();
}

function updateInBox($usua_doc)
{
    $xres = new xajaxResponse();
    $ruta_raiz = ".";
    include_once "{$ruta_raiz}/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler("{$ruta_raiz}");
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    switch ($db->driver) {
        case 'oci8':
            $query = "SELECT * FROM SGD_NOVEDAD_USUARIO WHERE USUA_DOC='{$usua_doc}'";
            break;
        case 'postgres':
            $campo = '"USUA_DOC"';
            $query = "SELECT * FROM SGD_NOVEDAD_USUARIO WHERE {$campo}='{$usua_doc}'";
            break;
    }
    $rs = $db->query($query);
    //var_dump($query);
    while (!$rs->EOF) {
        $xres->addScript("var lf=screen.width-380; var tp=screen.height-200; window.open('alert.php', 'ORFEO :: Bandeja de Entrada','width=460, height=200, status=0, toolbar=0, resizable=0, scrollbars=1, location=0, left='+lf+',top='+tp);");
        $rs->moveNext();
    }
    $xres->addAssign("folders", "innerHTML", ob_get_clean());
    return utf8_encode($xres->getXML());
}


function get_bed($inputId, $id, $id_sel = NULL) {
	$objResponse = new xajaxResponse();
	$kon = new Konek;
	$kon->sql = "SELECT id,nomor FROM ref_kamar WHERE pelayanan_id = '".$id."' AND status=0 ORDER BY nomor";
	$kon->execute();
	$data = $kon->getAll();	
	$objResponse->addAssign($inputId, "options.length", "1");
	for($i=0;$i<sizeof($data);$i++) {
		if($data[$i][id] == $id_sel)
			$objResponse->addScript("addOption('".$inputId."','".$inputId."kamar_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
		else
			$objResponse->addScript("addOption('".$inputId."','".$inputId."_kamar_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
	}
	//$objResponse->addScript("addOption('".$inputId."','".$inputId."_tidak_ada_dokter','Dokter Lain','',false,false);");
	return $objResponse;
}    		


function tutup_resep_rawat_jalan() {
	$objResponse = new xajaxResponse;
	$objResponse->addScriptCall("enable_mainbar");
	$objResponse->addAssign("modal_resep_rawat_jalan", "style.display", "none");
	$objResponse->addScript("document.getElementById('input_resep_rawat_jalan').reset()");	
	return $objResponse;
}

function disconnectUser($dn_name, $us_login)
{
    global $auth;
    $objResponse = new xajaxResponse();
    $auth->disconnectUser($dn_name, $us_login);
    $objResponse->addScript("document.location='connected_users.php'");
    return $objResponse->getXML();
}

function init()
{
    global $locate;
    $objResponse = new xajaxResponse();
    $objResponse->addAssign("divNav", "innerHTML", common::generateManageNav($skin));
    $objResponse->addAssign("divCopyright", "innerHTML", common::generateCopyright($skin));
    $objResponse->addScript("xajax_showGrid(0," . ROWSXPAGE . ",'','','')");
    return $objResponse;
}

function showStatus($curhover)
{
    $objResponse = new xajaxResponse();
    $html .= "<br><br><br><br>";
    $html .= asterEvent::checkExtensionStatus(0, 'table', $curhover);
    $objResponse->addAssign("divStatus", "innerHTML", $html);
    $objResponse->addScript("menuFix();");
    return $objResponse;
}

function init()
{
    global $locate;
    //,$config,$db;
    $objResponse = new xajaxResponse();
    $objResponse->addAssign("divNav", "innerHTML", common::generateManageNav($skin, $_SESSION['curuser']['country'], $_SESSION['curuser']['language']));
    $objResponse->addAssign("divCopyright", "innerHTML", common::generateCopyright($skin));
    $objResponse->addScript("xajax_showGrid(0," . ROWSXPAGE . ",'','','')");
    return $objResponse;
}

function xajax_redirect(&$anon_account)
{
    // now the header is included, we can set the charset
    $GLOBALS['xajax']->setCharEncoding('utf-8');
    define('XAJAX_DEFAULT_CHAR_ENCODING', 'utf-8');
    $response = new xajaxResponse();
    $response->addScript("location.href='" . $GLOBALS['phpgw_info']['server']['webserver_url'] . '/login.php?cd=10' . "';");
    header('Content-type: text/xml; charset=' . 'utf-8');
    echo $response->getXML();
    $GLOBALS['phpgw']->common->phpgw_exit();
}

function chkPassword($value)
{
    $mtview_controller = new MTViewController();
    $matchResult = $mtview_controller->xajaxObjCall($value, 'CPW', 'password');
    $objResponse = new xajaxResponse();
    if ($matchResult) {
        $objResponse->addScript("addUpdate();");
    } else {
        $objResponse->addAlert($GLOBALS['lang_Admin_Users_ErrorsPasswordMismatch']);
    }
    return $objResponse->getXML();
}

 function deleteEntry($entry_id)
 {
     $CI =& get_instance();
     $CI->load->model('feedback_model');
     $xajax_response = new xajaxResponse();
     if (is_numeric($entry_id) && $CI->feedback_model->DeleteFeedback($entry_id)) {
         $xajax_response->addAssign('new_entries', 'innerHTML', $CI->feedback_model->GetFeedbackCount());
         $xajax_response->addAssign('deleted_entries', 'innerHTML', $CI->feedback_model->GetFeedbackCount(1));
         $xajax_response->addAssign('feedback' . $entry_id, 'innerHTML', 'DELETED!');
         $xajax_response->addScript('Effect.BlindUp(\'container' . $entry_id . '\');');
     } else {
         $xajax_response->addAlert('Error deleting entry ' . $entry_id . ', reload the page and try again.');
     }
     return $xajax_response;
 }

 function _list()
 {
     $this->load->model('static_model');
     $list = $this->static_model->GetDirectoryListing($this->config->item('static_local_path') . '/podcasts', '', array('mp3'));
     $db_list = $this->podcasts_model->Get_Fnames();
     $arguments = '';
     foreach ($list as $fname) {
         if (!in_array($fname, $db_list)) {
             $arguments = $arguments . ',"' . str_replace(array('/', '\\'), '', $fname) . '"';
         }
     }
     $objResponse = new xajaxResponse();
     $objResponse->addScript('list_response(' . substr($arguments, 1) . ');');
     return $objResponse;
 }

function scribble($aFormValues)
{
    $sHandle = $aFormValues['handle'];
    $sWords = $aFormValues['words'];
    $objResponse = new xajaxResponse();
    $objGraffiti = new graffiti($sHandle, $sWords);
    $sErrMsg = $objGraffiti->save();
    if (!$sErrMsg) {
        $objResponse->addScript("xajax_updateWall();");
        $objResponse->addClear("words", "value");
    } else {
        $objResponse->addAlert($sErrMsg);
    }
    return $objResponse;
}

function showEditEmpStatForm($estatCode)
{
    $view_controller = new ViewController();
    $editArr = $view_controller->xajaxObjCall($estatCode, 'JOB', 'editEmpStat');
    $objResponse = new xajaxResponse();
    $objResponse->addScript("document.frmJobTitle.txtEmpStatDesc.disabled = false;");
    $objResponse->addScript("document.frmJobTitle.txtEmpStatID.value = '" . $editArr[0][0] . "';");
    $objResponse->addScript("document.frmJobTitle.txtEmpStatDesc.value = '" . $editArr[0][1] . "';");
    $objResponse->addScript("document.frmJobTitle.txtEmpStatDesc.focus();");
    $objResponse->addScript("document.frmJobTitle.txtEmpStatDesc.selectAll();");
    $objResponse->addScript("document.getElementById('layerEmpStat').style.visibility='visible';");
    $objResponse->addScript("document.getElementById('btnEmpStat').onclick=editFormData;");
    $objResponse->addAssign('status', 'innerHTML', '');
    return $objResponse->getXML();
}

function confirmUpload($url, $name){
	$objResponse = new xajaxResponse();
// 		$last_pos = strripos($url, '/');
// 		$length = strlen($url);
// 		$file_name=substr($url, $last_pos+1);
	if(copy($url, '../img/files/'.$name)){
		unlink($url);
		watermark('../img/files/'.$name, '../img/logo.png',0,72,1);
		$objResponse->addScript("confirmUpload_back('". $name. "');");
		//$objResponse->addAlert('success');
	}
	else{
		//$objResponse->addAlert('Fail');
	}
	//$objResponse->addAlert('test');	
	return $objResponse;
}

function reset_pasien () {
	$objResponse = new xajaxResponse();
	$objResponse->addScript("document.tambah_pasien.reset()");
	$objResponse->addClear("id_pasien", "value");
	$objResponse->addAssign("list_tombol_besar_kunjungan", "style.display", "none");
	//$objResponse->addScriptCall("fokus", "id");
	return $objResponse;
}