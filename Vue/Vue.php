<?php

include_once "Layout.php";

abstract class Vue {
    protected $content = '';
    protected $layout;

    public function __construct($layout) {
        $this->layout = $layout;
    }

    public function display(){
        $this->layout->display($this->content);
    }
    
}