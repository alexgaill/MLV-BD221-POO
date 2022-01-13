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
        case 'magique':
            $magique = new Magique;
            $magique->test("coucou");
            $magique->test1("coucou");
            Magique::testStatic();
            Magique::testStatic1();
            echo "<br>";
            $magique->privateProp = 2;
            $magique->testProp = "test";
            $magique->privateProp;
            $magique->testProp;
            $magique->testProp1;
            echo "<br>";
            isset($magique->privateProp);
            isset($magique->testProp);
            isset($magique->testProp1);
            // unset($magique->privateProp);
            // unset($magique->testProp);
            // unset($magique->testProp1);
            echo "<br>";
            var_dump(serialize($magique));
            echo "<br>";
            var_dump(unserialize(serialize($magique)));
            echo "<br>";
            echo $magique;
            echo "<br>";
            $magique(1, 3, 7, 12);
            echo "<br>";
            var_export($magique);
            echo "<br>";
            var_dump($magique);
            break;
        
        default:
            (new ErrorController)->urlError();
            break;
    }
} else {
    (new ArticleController)->index();
}