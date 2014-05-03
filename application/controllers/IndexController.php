<?php
class IndexController implements IController {
	public function indexAction() {
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$model = new FileModel();

		$model->name = "Гость";
		
		$output = $model->render(USER_DEFAULT_FILE);
		
		$fc->setBody($output);
	}
}
