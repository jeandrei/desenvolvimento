<?php
abstract class Controller{
	protected $request;
	protected $action;

	public function __construct($action, $request){
		$this->action = $action;
		$this->request =$request;
	}//construct

	public function executeAction(){
		return $this->{$this->action}();
	}//executeAction

	protected function returnView($viewmodel, $fullview){
		$view = 'views/'. get_class($this). '/' . $this->action. '.php';
		if($fullview){
			require('views/main.php');
		}else {
			require($view);
		}//if($fullview)
	}//returnView
}//class Controller

?>