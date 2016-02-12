<?php
/* ���� ��-��������� ��� ������ ������ */
set_include_path('application/controllers'.PATH_SEPARATOR.'application/models'.PATH_SEPARATOR.'application/views');
//some git master changes (for git)
//another changes
/* ����� ������: views */
define('USER_DEFAULT_FILE', 'user_default.php');
define('USER_ROLE_FILE', 'user_role.php');
define('USER_LIST_FILE', 'user_list.php');
define('USER_ADD_FILE', 'user_add.php');

/* ��������� ���� ������ ������������� */
define('USER_DB', $_SERVER["DOCUMENT_ROOT"].'/data/users.txt');

/* ������������� ������� */
function __autoload($class){
	require_once($class.'.php');
}

/* ������������� � ������ FrontController */
$front = FrontController::getInstance();
$front->route();

/* ����� ������ */
echo $front->getBody();
