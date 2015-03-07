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
//{"email":"test@qq.com","title":"test","content":"test"}:

        $to = "xiaoqiaonz@gmail.com"; // this is your Email address
        $from = $request['email']; // this is the sender's Email address

        $subject = $request['title'];
        $subject2 = "Copy of your form submission: ".$request['title'];
        $message = " wrote the following:" . "\n\n" . $request['content'];
        $message2 = "Here is a copy of your message " . "\n\n" . $request['content'];

        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        mail($to, $subject, $message, $headers);
        mail($from, $subject2, $message2, $headers2);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        
    }

}
