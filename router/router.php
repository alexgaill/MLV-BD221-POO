<?php
use App\Controller\ArticleController;
use App\Controller\ErrorController;
use App\Fixtures\AppFixtures;
use Classe\Magique;

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
        case 'fixtures':
            (new AppFixtures)->load();
            break;
        
        default:
            (new ErrorController)->urlError();
            break;
    }
} else {
    (new ArticleController)->index();
}