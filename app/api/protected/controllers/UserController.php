<?php

class UserController extends Controller {

    const JSON_RESPONSE_ROOT_SINGLE = 'user';
    const JSON_RESPONSE_ROOT_PLURAL = 'users';

    public function actionIndex() {

        $models = Yii::app()->db->createCommand()
                ->select('*')
                ->from('user')
                ->queryAll();
        $tempArray = array();
        foreach ($models as $model) {
            array_push($tempArray, $model);
        }
        $json = json_encode($tempArray);

        $this->sendResponse(200, $json);
    }

    public function actionRead() {
        $temp = explode("/", $_SERVER['REQUEST_URI']);
        $id = $temp [sizeof($temp) - 1];
        $model = User::model()->findByPk($id);
        unset($model->Password);
        $json = $this->objtoJson(self::JSON_RESPONSE_ROOT_SINGLE, $model);
//        var_dump($model);
        $this->sendResponse(200, $json);
    }

    public function actionCreate() {

        $request = $this->getClientPost();
        $model = User::model()->findByAttributes(array(
            'email' => $request['email']
        ));

        if (!$model) {
            $model = new User;
            $model->setAttributes($request);
            $model->UserType = 1;
            $model->createTime = new CDbExpression(' UTC_TIMESTAMP()');
            $model->lastUpdateTime = new CDbExpression('UTC_TIMESTAMP()');

            if ($model->validate()) {
                $model->save(false);
                echo "create";
            } else {
                $this->sendResponse(500);
            }
        } else {
            echo "email registered";
        }
    }

}
