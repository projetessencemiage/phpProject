<?php
require_once 'application/inc/declarations.inc.php';
$body = 'listestations.body.php';

//$clientSoap = new SoapClient("http://192.168.0.1:8084/AffichagePrix.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));

/*
try {
	$ret = $clientSoap->GetPrixCodePostal(array("codePostal" => 33000));
	$tab = (array)$ret;
	
	foreach($tab as $key => $value) {
		echo $key."\n";
		$tab2 = (array)$value;
		foreach($tab2 as $key2 => $value2) {
			echo $key2."\n";
		}
	}
	//$xml = simplexml_load_string($clientSoap->__doRequest($request, $location, $action, $version), 'SimpleXMLElement', LIBXML_NOCDATA);
	echo "---------------".NL;
	//var_dump($tab);
}
catch(Exception $e) {
	return false;
};

*/
//$xml = simplexml_load_string($ret->GetPrixCodePostalResult, 'SimpleXMLElement', LIBXML_NOCDATA);



// function enforce_array($obj) {
// 	$array = (array)$obj;
// 	if(empty($array)) {
// 		$array = '';
// 	}
// 	else {
// 		foreach($array as $key=>$value) {
// 			if(!is_scalar($value)) {
// 				if(is_a($value,'SimpleXMLElement')) {
// 					$tmp = memcache_objects_to_array($value);
// 					if(!is_array($tmp)) {
// 						$tmp = ''.$value;
// 					}
// 					$array[$key] = $tmp;
// 				}
// 				else {
// 					$array[$key] = enforce_array($value);
// 				}
// 			}
// 			else {
// 				$array[$key] = $value;
// 			}
// 		}
// 	}
// 	return $array;
// }


echo Structure::getHeader();
echo Structure::getBody($body);
?>