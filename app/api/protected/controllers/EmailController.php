<?php

class EmailController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        error_log("asdfasdfasdfa");
        echo "index";
    }

    public function actionRead() {
        echo "readddddd";
    }

    public function actionCreate() {
        echo "this is create";
    }

    public function actionSend() {

        $request = $this->getClientPost();
        $title = $request['title'];
        $hosturl = $_SERVER['HTTP_HOST'] . '/images/email/';


        $body = $request['content'];
        $to = "xiaoqiaonz@gmail.com"; // this is your Email address
        $from = $request['email']; // this is the sender's Email address

        $this->sendEmail($to, $from, $title, $body);
        $this->sendEmail($from, $to, $title, $body);
        $this->sendResponse(200, $hosturl);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        
    }

}
