<?php

class Recursive{

	public $arrTmp;

	public static $arrDeep = [
	    1 => 0,
		2 => 1,
		3 => 2,
		4 => 2,
		5 => 3,
		6 => 4
	];

	public static function getInstance($intChildId){
	    foreach(self::$arrDeep as $childId => $parentId){
	        if($childId == $intChildId){
	            return [$childId, $parentId];
	        }
	    }
	    return [];
	}

	public function getChildren($intParentId){
	    $qarr = [];
	    foreach(self::$arrDeep as $childId => $parentId){
	        if($parentId == $intParentId){
	            $qarr[$childId] = $parentId;
	        }
	    }
	    return $qarr;
	}

	public function getTree($arChild = null) {
		if (empty($arChild)) {
			list($keyChildId, $parentId) = self::getInstance(1);
			foreach ($this->getChildren($keyChildId) as $keyChildId => $parentId) {
				list($keyChildId, $parentId) =  self::getInstance($keyChildId);
				$this->arrTmp[$keyChildId] = $parentId;
				$this->getTree(array($keyChildId));
			}
		}
		else {
			foreach ($arChild as $keyChildId => $parentId) {
				list($keyChildId, $parentId) = self::getInstance($parentId);
				foreach ($this->getChildren($keyChildId) as $keyChildId => $parentId) {
					if (!empty($keyChildId)) {
						list($keyChildId, $parentId)  = self::getInstance($keyChildId);
						if (!empty($keyChildId)) {
						    $this->arrTmp[$keyChildId] = $parentId;
					        $this->getTree(array($keyChildId));
						}
					}
				}
			}
		}
		return $this->arrTmp;
	}

	public function getTreeShort($parent,$bRecursive = false) {
		$arrReturn = array();
		foreach ($this->getChildren($parent) as $ckey => $cparent) {
			$arrReturn[$ckey] = $cparent;
			if ($bRecursive) {
				foreach ($this->getTreeShort($ckey,true) as $key => $parent) {
					$arrReturn[$key] = $parent;
				}
			}
		}
		return $arrReturn;
	}
}

$oRecursive = new Recursive();
$arrResult = $oRecursive->getTree([1]);
print "----------------------------------".PHP_EOL;
print_r($arrResult);
$arrResult = $oRecursive->getTreeShort(1,true);
print "----------------------------------".PHP_EOL;
print_r($arrResult);


/*
----------------------------------
Array
(
    [2] => 1
    [3] => 2
    [5] => 3
    [4] => 2
    [6] => 4
)
----------------------------------
Array
(
    [2] => 1
    [3] => 2
    [5] => 3
    [4] => 2
    [6] => 4
)

https://sandbox.onlinephpfunctions.com/
https://extendsclass.com/php.html
https://wtools.io/php-sandbox
https://www.codegrepper.com/code-examples/php/phptester
http://phpfiddle.org/
*/
