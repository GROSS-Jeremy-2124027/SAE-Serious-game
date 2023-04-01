<?php
namespace Vue;

include_once "Layout.php";

/**
 * Classe abstraite représentant la vue
 */
abstract class Vue
{

    protected $title = '';
    protected $content = '';
    protected $layout;

    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Affiche la page
     */
    public function display()
    {
        $this->layout->display($this->title, $this->content);
    }

}