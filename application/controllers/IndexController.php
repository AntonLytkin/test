<?php
class IndexController implements IController {
	public function indexAction() {
		$fc = FrontController::getInstance();
		/* ������������� ������ */
		$model = new FileModel();

		$model->name = "�����";
		
		$output = $model->render(USER_DEFAULT_FILE);
		
		$fc->setBody($output);
	}
}
