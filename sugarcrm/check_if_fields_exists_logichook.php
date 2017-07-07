<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 13.10.15
 * Time: 16:30
 */

class SomeLogicHookHere {

	/**
	 * @return bool
	 * Search an specific field in some specific Module
	 */

	function CheckFieldExists(){
		$module_list = array_intersect($GLOBALS['moduleList'],array_keys($GLOBALS['beanList']));
		foreach($module_list as $module_name) {
			if($module_name=="Opportunities"){
				$bean = BeanFactory::getBean($module_name);
				$field_defs[$module_name] = $bean->getFieldDefinitions();
			}
		}

		$fieldFound = false;
		foreach( $field_defs["Opportunities"] as $key => $dfieldObj ){
			if($key=="some_searched_field"){
				$fieldFound = true;
			}
			//echo $key."<br>";
			//echo $dfieldObj['name']."<br>";
		}
		return $fieldFound;
	}

}

