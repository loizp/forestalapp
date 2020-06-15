<?php
	ini_set('include_path',ini_get('include_path').'.;');
	session_start();
	
	// Include Libraries
        include_once("lib/funciones.php");
	include_once("lib/JSON.php");
        include_once("lib/jsgrid.php");
        include_once("lib/jsgridbdORM.php");
	
 	error_reporting(0);
	error_reporting(E_ALL);
	
	if ( ! file_exists ( 'templates_c' ) ) { mkdir ('templates_c'); chmod("templates_c", 0777); }

	global $debug;

	$debug = true;

	function debug($obj, $title = null)
	{
		global $debug;
		if ( ! $debug ) return false;
		if ( $title != null ) echo "<h2>$title</h2>";
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
	}

include_once("smarty/Smarty.class.php");
include_once("controllers/cindex.php");

$args = ControllerBase::breakURL();

global $smarty;
$smarty = new Smarty();
$smarty->allow_php_tag = true;
$smarty->error_reporting = 2;

try{

$app =  new cIndex($args);

$app->Run();
}catch(Exception $e){
	debug($e);
}
?>