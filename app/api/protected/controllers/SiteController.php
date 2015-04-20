<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
    }

    public function actionCheckState() {
        //get user input
        $temp_request = $this->getClientPost();
        $request = CJSON::decode($temp_request, true);
        $sessionid = $request['session_id'];
        // get session
        $connection = Yii::app()->db;
        $sql = 'SELECT * FROM sessionTable WHERE id = :sessionid';
        $command = $connection->createCommand($sql);
        $command->bindParam(':sessionid', $sessionid, PDO::PARAM_STR);
        $rowCount = $command->execute();
        $dataReader = $command->queryAll();
        if ($rowCount == 1) {
            $session_record = $dataReader[0]["data"];
            $id = $this->getSessionVarByName('UserId', $session_record);
            $this->sendResponse(200, $id);
        } else {
            echo "SESSION_MISSING";
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {

        $request = $this->getClientPost();

        if (isset($request['username']) && isset($request['password'])) {
            $identity = new UserIdentity($request['username'], $request['password']);
        } else {
            $this->sendResponse(200, '{"error":"ERROR_USERNAME_INVALID"}');
        }

        $error_code = $identity->authenticate();

        if ($error_code == UserIdentity::ERROR_USERNAME_INVALID) {
            $this->sendResponse(200, '{"error":"ERROR_USERNAME_INVALID"}');
        } else if ($error_code == UserIdentity::ERROR_PASSWORD_INVALID) {
            $this->sendResponse(200, '{"error":"ERROR_PASSWORD_INVALID"}');
        } else {//create session, correct data
            Yii::app()->session->add('UserId', $identity->getId());
            $date = new DateTime();
            Yii::app()->session->add('date', $date->format('Y-m-d H:i:s'));
            $model = User::model()->findByPk($identity->getId());
            $arr = $model->attributes;
            unset($arr['password']);
            $this->sendResponse(200, json_encode($arr));
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionTest() {
        echo "test";
    }

}
