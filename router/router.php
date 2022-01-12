<?php
use App\Controller\ArticleController;
use App\Controller\ErrorController;

if (isset($_GET["page"]))
{
    switch ($_GET["page"]) {
        case 'singleArt':
            (new ArticleController)->single();
            break;
        case 'saveArt':
            (new ArticleController)->save();
            break;
        case 'updateArt':
            (new ArticleController)->update();
            break;
        case 'deleteArt':
            (new ArticleController)->delete();
            break;
        
        default:
            (new ErrorController)->urlError();
            break;
    }
} else {
    (new ArticleController)->index();
}