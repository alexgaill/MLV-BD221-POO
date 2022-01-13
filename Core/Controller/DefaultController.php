<?php
namespace Core\Controller;

use App\Trait\SecurityTrait;

class DefaultController {
    use SecurityTrait;

    protected function render(string $pathView, array $params = [])
    {
        ob_start();
        extract($params);
        include ROOT . "/templates/$pathView.phtml";
        $content = ob_get_clean();
        include ROOT . '/templates/base.phtml';
    }
}