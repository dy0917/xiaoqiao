<?php

class BankratioController extends Controller {

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $models = Yii::app()->db->createCommand()
                ->select('*')
                ->from('bankratio')
                ->queryAll();
        $tempArray = array();
        foreach ($models as $model) {
            array_push($tempArray, $model);
        }
        $json = json_encode($tempArray);

        $this->sendResponse(200, $json);
    }

    public function actionRead() {
        
    }

    public function actionCreate() {
        echo "this is create";
    }

    public function actionUpdate() {
        $request = $this->getClientPost();
        $model = Bankratio::model()->findByPk($request["id"]);
        $model->setAttributes($request);
        $model->LastUpdateTime = new CDbExpression('UTC_TIMESTAMP()');
        if ($model->validate()) {
            $model->save(false);
            echo "updateSeccessful";
        } else {
            $this->sendResponse(500);
        }
    }

}
