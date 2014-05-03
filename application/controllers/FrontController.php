<?php
class FrontController {
	protected $_controller, $_action, $_params, $_body;
	static $_instance;

	public static function getInstance() {
		if(!(self::$_instance instanceof self)) 
			self::$_instance = new self();
		return self::$_instance;
	}
	private function __construct(){
		$request = $_SERVER['REQUEST_URI'];
		$splits = explode('/', trim($request,'/'));//������� ����� �� ������ � ����� URI � ����������� � ������
		//����� �����������
		$this->_controller = !empty($splits[0]) ? ucfirst($splits[0]).'Controller' : 'IndexController';
		//����� action
		$this->_action = !empty($splits[1]) ? $splits[1].'Action' : 'indexAction';
		//������� ���������� � ��������
		if(!empty($splits[2])){
			$keys = $values = array();
				$cnt = count($splits);
				for($i=2; $i<$cnt; $i++){
					if($i % 2 == 0){
						//���� ������, �� ��� ��������
						$keys[] = $splits[$i];
					}else{
						//���� ��������, �� ��� �������� ���������;
						$values[] = $splits[$i];
					}
				}
			if(count($keys)==count($values))
				$this->_params = array_combine($keys, $values);
			else{
				echo '�������� ��������� ������� �������, ���� �����������!';
				exit;
				}
		}
	}
	public function route() {
	try{
		if(file_exists('application/controllers/'.$this->getController().'.php')) {
			$rc = new ReflectionClass($this->getController());
			if($rc->implementsInterface('IController')) {
				if($rc->hasMethod($this->getAction())) {
					$controller = $rc->newInstance();
					$method = $rc->getMethod($this->getAction());
					$method->invoke($controller);
				} else {
					throw new Exception("�������� ��������� ������� �������, ���� �����������!");
				}
			} else {
				throw new Exception("Interface");
			}
		} else {
			throw new Exception("���������� ���� ����������� �� ����������!");
		}
		
	 }catch(Exception $e){
		echo $e->getMessage();
	 }
	}
	public function getParams() {
		return $this->_params;
	}
	public function getController() {
		return $this->_controller;
	}
	public function getAction() {
		return $this->_action;
	}
	public function getBody() {
		return $this->_body;
	}
	public function setBody($body) {
		$this->_body = $body;
	}
}	