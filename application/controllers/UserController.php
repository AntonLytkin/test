<?
class UserController implements Icontroller{
    function helloAction(){
        $fc=FrontController::getInstance();
        $par=$fc->getParams();
        $model=new FileModel();
        $model->name=$par['name'];
        $body=$model->render(USER_DEFAULT_FILE);
        $fc->setBody($body);
    }
    function listAction(){
        $fc=FrontController::getInstance();
        $model=new FileModel();
		if(!is_file(USER_DB))
			echo 'Базы данных нет! Добавьте нового пользователя!';
		else{
        $ser=file_get_contents(USER_DB);
        $model->list=unserialize($ser);
        $body=$model->render(USER_LIST_FILE);
        $fc->setBody($body);
		}
    }
    function getAction(){
        $fc=FrontController::getInstance();
        $par=$fc->getParams();
		if(!$par){
			echo 'Введите ../role/Имя_пользователя!';
			exit;
		}
        $model=new FileModel();
        $model->name=$par['role'];
		if(!is_file(USER_DB)){
			echo 'Базы данных нет! Добавьте нового пользователя!';
		}else{
        $ser=file_get_contents(USER_DB);
        $model->list=unserialize($ser);
        if(array_key_exists($model->name, $model->list)){
            $body=$model->render(USER_ROLE_FILE);
            $fc->setBody($body);
        }else{
            $model->error='Такого пользователя нет';
            $body=$model->render(USER_ROLE_FILE);
            $fc->setBody($body);
        }
    }
	}
    function addAction(){
        $fc=FrontController::getInstance();
        $par=$fc->getParams();
		if(!$par){
			echo 'Введите имя и роль пользователя!';
			exit;
		}
		if(count($par)==1){
			echo 'Введите роль пользователя!';
			exit;
		}
        $model=new FileModel();
		if(is_file(USER_DB)){
		$ser=file_get_contents(USER_DB);
        $unser=unserialize($ser);
		}    
        $unser[$par['name']]=$par['role'];
        $upser=serialize($unser);
        file_put_contents(USER_DB, $upser);
        $model->name=$par['name'];//Для вывода в user_add.php
        $model->role=$par['role'];//Для вывода в user_add.php
        $body=$model->render(USER_ADD_FILE);
        $fc->setBody($body);
    }

}