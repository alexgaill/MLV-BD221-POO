<?php
namespace App\Fixtures;

use App\Model\ArticleModel;
use App\Model\CategorieModel;
use Faker\Factory;

final class AppFixtures{

    public function load()
    {
        $faker = Factory::create('fr-FR');
        $catModel = new CategorieModel;
        $artModel = new ArticleModel;

        for ($i=0; $i < 5; $i++) { 
            $categorie = [
                "name" => $faker->words(3, true)
            ];
            $lastCat = $catModel->save($categorie);

            for ($j=0; $j < 10; $j++) { 
                $article = [
                    "title" => $faker->sentence(6, true),
                    "content" => $faker->sentences(5, true),
                    "categorie_id" => $lastCat
                ];
                $artModel->save($article);
            }
        }

        echo "Les données sont bien enregistrées";
        header("Refresh: 3; index.php");
    }
}