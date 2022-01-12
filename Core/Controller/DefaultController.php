<?php
namespace Core\Controller;

class DefaultController {

    protected function render(string $pathView, array $params = [])
    {
        ob_start();
        extract($params);
        include ROOT . "/templates/$pathView.phtml";
        $content = ob_get_clean();
        include ROOT . '/templates/base.phtml';
    }
}