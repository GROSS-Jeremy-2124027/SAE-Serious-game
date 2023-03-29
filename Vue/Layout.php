<?php
namespace Vue;

class Layout {
    protected $templateFile;

    public function __construct($templateFile) {
        $this->templateFile = $templateFile;
    }

    public function display($title, $content) {
        $page = file_get_contents($this->templateFile);
        $page = str_replace('%content%', $content, $page);
        echo $page;
    }
}