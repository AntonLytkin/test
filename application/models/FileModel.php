<?php
class FileModel{
	/* ��� ������������ */
	public $name = '';
	/* ������ ������������� */
	public $list = array();
	/* ������� ������������: ������������� ������ � ���������� role � name ��� ������������� ������������ 
	* ��� ������ � ��������� name ��� ������������ ������������
	*/
	public $user = array();
	
	public function render($file) {
		ob_start();
		include($file);
		return ob_get_clean();
	}
}