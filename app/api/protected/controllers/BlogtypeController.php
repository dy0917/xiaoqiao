<?php

class BlogtypeController extends Controller {

    public function actionIndex() {

        $models = Yii::app()->db->createCommand()
                ->select('*')
                ->from('BlogType')
                ->queryAll();
        $tempArray = array();
        foreach ($models as $model) {
            array_push($tempArray, $model);
        }
        $json = json_encode($tempArray);

        $this->sendResponse(200, $json);
    }

        public function actionGetfilter() {

        $models = Yii::app()->db->createCommand()
                ->select('*')
                ->from('BlogType')
                ->where('BlogType.BlogTypeid<4')
                ->queryAll();
        $tempArray = array();
        foreach ($models as $model) {
            array_push($tempArray, $model);
        }
        $json = json_encode($tempArray);

        $this->sendResponse(200, $json);
    }
    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
