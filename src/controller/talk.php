<?php
require_once("model/talk.php");

class TalkController
{
    public $talks;
    public $templates;

    public function __construct()
    {
        $this->talks = new TalkModel();
        $this->templates = new League\Plates\Engine('view');
    }

    public function display()
    {
        echo $this->templates->render('talk', ['talks' => $this->talks->getTalkList(json_decode(file_get_contents("config.json")))]);
    }
}