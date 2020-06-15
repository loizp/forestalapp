<?php

//Autor: Necudeco
//Email: necudeco@necudeco.com
//Blog : http://necudeco.com
//Web  : http://necudeco.com
//Licencia: GPL3
//Version: 040309-01

include_once("ACL.php");

abstract class ControllerBase
{

	protected $defaultaction;
	protected $action = null;
	protected $template="_blank.phtml";
	
	protected $parent = null;
	protected $model = null;

	protected $route = array();
						// array(<action>=><ClassName>)
						
	protected $autoRoute = false;
	
	public static $debug = true;
	protected $display = null;
	
	public function __construct(&$args)
	{
		$this->args = $args;
		$this->index = "index.php";
		$this->URLBase = str_replace($this->index,"",$_SERVER["SCRIPT_NAME"]);
		$this->serverIP = $_SERVER["SERVER_NAME"];
		$this->serverPort = $_SERVER["SERVER_PORT"];
		$this->serverProtocol = explode("/",$_SERVER["SERVER_PROTOCOL"]);
		$this->serverProtocol = $this->serverProtocol[0];
		
		$this->clientIP = $_SERVER["REMOTE_ADDR"];

		$this->init();
	}

	protected function init()
	{
		// Codigo de Inicializacion del Controlador
	}

	protected function getParameter()
	{
		return array_shift($this->args["params"]);
	}


	public function callMethod($method,$caller='Action')
	{	
		if ( array_key_exists('__debug',$_REQUEST) )
		{
			if ( class_exists("ORMBase")  )
			{
				ORMBase::debug(true);
				unset($_REQUEST['__debug']);
			}
		} 
		
		try{
				return $this->$method();	
			}catch(ORMException $e)
			{
				global $smarty;
				$err = $caller."Error";
				//$e->setMessage($smarty->fetch('error.html'));
				debug($e);
				$e2 = new Exception($smarty->fetch('error.html'),$e->getCode());
				
				$this->$err($e2);
			}
		
	}

	private function ActionError($e)
	{
		global $smarty;
		$smarty->clear_all_assign();
		$smarty->assign('nroerror',$e->getCode());
		die($smarty->fetch('error.html'));		
	}
	
	private function JsonError($e)
	{
		global $smarty;
		
		$response = array();
		$response['code'] = "ERROR";
			
		$smarty->assign('nroerror',$e->getCode());
			
		$response['message'] = $e->getMessage();//$smarty->fetch('error.html');
		$response['log'] = $e->getCode();

		die(json_encode($response));
	}
	
	private function XmlError($e)
	{
		header("Content-type:text/xml");

		$dom = new DOMDocument();
		$err = $dom->createElement("error");
		$dom->appendChild($err);
					
		$err->setAttribute("code",0);
		$err->setAttribute("message",$e->getMessage());
					
		die($dom->saveXML());
	}
	
	public function ActionRun($actionName)
	{
		return $this->callMethod($actionName);
	}
	
	public function JsonRun($actionName)
	{	
		$response = array();
		try{
			$aux = $this->callMethod($actionName,'Json');  

			$response['code'] = 'OK';
			$response['response'] = $aux;

			die(jsonEncode($response));
		}
		catch(Exception $e){
			$this->JsonError($e);
		}
		
		return true;		
	}
	
	private function toXML($rs)
	{
    	$dom = new DOMDocument('1.0');
    
    	$xreport = $dom->createElement('xml');
    	$dom->appendChild($xreport);

    	if ( count($rs) > 0 )
    	{
    		foreach( $rs as $item )
    		{
	        	$xrow = $dom->createElement('row');
        		foreach( $item as $key => $data)
        		{
            		$xcol = $dom->createElement($key);

		            $text = $dom->createTextNode($data);
    		        $xcol->appendChild($text);

        		    $xrow->appendChild($xcol);
        		}
        		$xreport->appendChild($xrow);
    		}
    	}
		return $dom;
	}
	
	
	public function XmlRun($actionName)
	{
			$response = array();
				try
				{
					$aux = $this->callMethod($actionName,'Xml'); 
					if ( $aux instanceof ORMBase ) $aux = $aux->toXML();
					if ( $aux instanceof ORMCollection ) $aux = $aux->toXML();
					if ( !( $aux instanceof DOMDocument ) ) $aux = $this->toXML($aux);
					
					
					header("Content-type:text/xml");
					die($aux->saveXML());
					
				}
				catch(Exception $e)
				{
					header("Content-type:text/xml");

					$dom = new DOMDocument();
					$err = $dom->createElement("error");
					$dom->appendChild($err);
					
					$err->setAttribute("code",0);
					$err->setAttribute("message",$e->getMessage());
					
					die($dom->saveXML());
				
				}
				return true;		
	}
	
	public function Run()
	{	

		$this->event = "200";
	
		$this->action = ( ($this->action = array_shift($this->args["params"])) == null ) ? $this->defaultaction: $this->action;
		
		$this->type 	= ( isset($_REQUEST['ajax']) )?($_REQUEST['ajax']=='xml')?'xml':'json':'Action';
		$this->ftype 	= ( isset($_REQUEST['ajax']) )?'Ajax':'Action';
		
		$actionName = $this->action.$this->ftype; 

		$this->actionName = $actionName;

		if ( ! ACL::access(get_class($this), $this->action, $this) ) {
			$this->event = "403";
		}else{
			$this->event = "200";
			if ( array_key_exists($this->action, $this->route) ){
				$className = $this->route[$this->action];

				include_once(strtolower("controllers/$className.php"));

				$mod = new $className($this->args);
				$mod->parent = get_class($this);

				return $mod->Run();

			}else{
				if ( method_exists($this, $actionName) or method_exists($this,"__call")){
					$execute = $this->type."Run";
					return $this->$execute($actionName);
				}
				$this->event = "404";
			}

			return CIndex::__404();
		}
		return CIndex::__403();

	}

	
	protected function __404()
	{
		cIndex::_404();
	}
	
	protected function __403($message=null)
	{
		cIndex::_403();
	}
	
	// Establece si el usuario actual tiene acceso al modulo solicitado
	public function rights()
	{
		return true;
	}
	
	protected function selectAjax()
	{
		if ( $this->model == '' ) return $this->__404();
		
		$className = $this->model;
		$fileName = strtolower($className);
		
		if ( ! class_exists($className) )
			include_once("models/$fileName.php");
			
		$obj = new $className();
		$obj->find($_REQUEST);
		
		return $obj; 
		
	}
	
	public function deleteAjax()
	{
		if ( $this->model == '' ) return $this->__404();
		
		$className = $this->model;
		$obj = new $className();
		$obj->find($_REQUEST);
		
		$obj->delete();
	}
	
	public function listAjax($postProcess = false)
	{
		if ( $this->model == '' ) return $this->__404();
		
		$offset = @$_REQUEST['o'];
		$limit = @$_REQUEST['l'];
		
		if ( ! is_numeric($offset) || $offset < 0 ) $offset = 0;
		if ( ! is_numeric($limit) || $limit < 0 ) $limit = 10;
	
		unset($_REQUEST['o']);
		unset($_REQUEST['l']);
		unset($_REQUEST['ajax']);
		unset($_REQUEST['PHPSESSID']);

		$cond = null;
		if ( count($_REQUEST) > 0 )
		{
			$cond = new ORMCondition();
			foreach ( $_REQUEST as $k => $i)
			{
				$cond->andCondition("$k =",$i);
			}
		}

		$className = $this->model;
/**************************/
    	//$className = get_called_class();
    	
    	$obj = new $className();
    	
    	//if ( ! is_numeric($o) || $o < 0 ) $o = 0;
    	//if ( ! is_numeric($l) || $l <= 0) $l = 10;
    	
    	$objs = $obj->getAll();
    	if ( $cond != null ) $objs = $objs->whereCondition($cond);
    	
		
    	//return $obj;
/*************************************/

		if ( $postProcess ){
			$_REQUEST['o'] = $offset;
			$_REQUEST['l'] = $offset;

			return $objs;
		}


		return $this->limit($objs,$offset,$limit);

		//$objs = $className::listAll($cond);
		$count = $objs->count();
		$objs->seek($offset);

		$objs = $objs->getArray($limit);

		$response = array();
		$response['count'] = $count;
		foreach($objs as $obj)
			$response['data'][] = $obj;

		//return $response;
		return $objs;
	}

	public function limit($obj, $o, $l){
		$response = array();
		$response['count'] = $obj->count();

		$obj->seek($o);
		$response['data'] = $obj->getArray($l);

		return $response;
	}

	public function saveAjax()
	{
		if ( $this->model == '' ) return $this->__404();

		$className = $this->model;

		$obj = new $className();

		try{
			$obj->find($_REQUEST);
		}catch(Exception $e)
		{
			$obj->setFields($_REQUEST);
			$obj->create(true);

			return $obj;
		}

		$obj->setFields($_REQUEST);
		$obj->update();

		return $obj;
	}
	
	
	static public function breakURL()
	{
	
		// Buscando parametros pasados por GET

        $url = explode("?",$_SERVER["REQUEST_URI"]);
        if ( isset($url[1]))
        {
            parse_str($url[1], $_GET);
        }
        
		$params = substr($url[0],strlen($_SERVER["SCRIPT_NAME"])+1);
		if ($params{strlen($params)-1} === "/" ) $params = substr($params,0,strlen($params)-1);
	
	
		$params = explode("/",$params);
		
		return array("params"=>$params);
	}
	
	
	public function redirect($redirectto="",$message="")
	{
/*		$address  = "$this->serverProtocol://$this->serverIP:$this->serverPort{$this->URLBase}{$this->index}/$redirectto";
		$address .= "?message=$message";
		header("Location: $address");

	*/
		 session_write_close();
        $message = ($message == '')?'':"?message=$message";
		//die("<script> document.location = '/index.php/$redirectto$message'; </script>");
        header("Location: /index.php/$redirectto$message");

	}


}
?>
