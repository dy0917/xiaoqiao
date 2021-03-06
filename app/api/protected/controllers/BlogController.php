<?php

class BlogController extends Controller {

    const JSON_RESPONSE_ROOT_SINGLE = 'blog';
    const JSON_RESPONSE_ROOT_PLURAL = 'blogs';

    public function actionIndex() {

//        $criteria = new CDbCriteria;
//        $criteria->select = 't.id';

        $models = Yii::app()->db->createCommand()
                ->select('*')
                ->from('Blog, BlogStatus')
                ->where('Blog.BlogStatusid=BlogStatus.BlogStatusid')
                ->queryAll();
        $json = json_encode($models);
        $this->sendResponse(200, $json);
    }

    public function actionRead() {
        $temp = explode("/", $_SERVER['REQUEST_URI']);
        $id = $temp [sizeof($temp) - 1];
        $model = Blog::model()->findByPk($id);
        $json = $this->objtoJson(self::JSON_RESPONSE_ROOT_SINGLE, $model);
        $this->sendResponse(200, $json);
    }

    public function actionCreate() {

        $request = $this->getClientPost();
        $model = new Blog;
        $model->setAttributes($request);
        $model->CreatebyUser = 3;
        $model->createTime = new CDbExpression(' UTC_TIMESTAMP()');
        $model->LastUpdateTime = new CDbExpression('UTC_TIMESTAMP()');

        if ($model->validate()) {
            $model->save(false);
            $model->createTime = date("Y-m-d H:i:s");
            $arrjson = $model->attributes;
            $arrjson['BlogStatus'] = $request['BlogStatus'];
            $json = json_encode($arrjson);
            echo $json;
        } else {

            $this->sendResponse(500);
        }
    }

    public function actionGethomepageblog() {
        $models1 = Yii::app()->db->createCommand()
                ->select('*')
                ->from('Blog')
                ->where('Blog.BlogTypeid=1')
                ->limit(3)
                ->where('Blog.BlogStatusid=1')
                ->queryAll();
        $models2 = Yii::app()->db->createCommand()
                ->select('*')
                ->from('Blog')
                ->where('Blog.BlogTypeid=2')
                ->limit(3)
                ->where('Blog.BlogStatusid=1')
                ->queryAll();
        $models3 = Yii::app()->db->createCommand()
                ->select('*')
                ->from('Blog')
                ->where('Blog.BlogTypeid=3')
                ->where('Blog.BlogStatusid=1')
                ->limit(3)
                ->queryAll();
        $models = array_merge($models1, $models2, $models3);
        $json = json_encode($models);
        $this->sendResponse(200, $json);
    }

    public function actionGetsataticblog() {
        $request = $this->getClientPost();
        $condiction = 'Blog.BlogTypeid=';
     
        if ($request["BlogTypeid"]) {
            $condiction = $condiction .$request["BlogTypeid"];
        } else {
            $condiction = '';
        }

        $models = Yii::app()->db->createCommand()
                ->select('*')
                ->from('Blog')
                ->where($condiction)
                ->andWhere('Blog.BlogStatusid=1')
                ->queryAll();
        $json = json_encode($models);
        $this->sendResponse(200, $json);
    }

    public function actionUpdate() {
        $request = $this->getClientPost();
        $model = Blog::model()->findByPk($request["Blogid"]);

        $model->setAttributes($request);

        $model->LastUpdateTime = new CDbExpression('UTC_TIMESTAMP()');
        if ($model->validate()) {
            $model->save(false);
            echo "updateSeccessful";
        } else {

            $this->sendResponse(500);
        }
    }

    public function actionDelete() {
        $request = $this->getClientPost();
        $model = Blog::model()->findByPk($request["Blogid"]);

        if ($model->validate()) {
            $model->delete();
            echo "updateSeccessful";
        } else {

            $this->sendResponse(500);
        }
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
