<?php
namespace Vue;

/**
 * Classe représentant la vue
 */
class Layout
{
    protected $templateFile;

    public function __construct($templateFile)
    {
        $this->templateFile = $templateFile;
    }

    /**
     * Affiche la page
     */
    public function display($title, $content)
    {
        $page = file_get_contents($this->templateFile);
        $page = str_replace('%content%', $content, $page);
        echo $page;
    }
}