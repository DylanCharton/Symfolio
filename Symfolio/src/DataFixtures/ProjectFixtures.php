<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Project;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        for ($j = 1; $j <= 3; $j++){
            $category = new Category();
            $category->setTitle("Catégorie n°$j");
            $category->setDescription("Description de la catégorie n°$j");

            $manager->persist($category);
            for ($i = 1; $i <= mt_rand(4,6); $i++){
            $projet = new Project();
            $projet->setTitle("Titre du projet n°$i")
                   ->setDescription("<p>Contenu de l'article n°$i</p>")
                   ->setImage("e3b2dfae701de7b02a8c711c326654aa.png")
                   ->setGithub("https://github.com/DylanCharton")
                   ->setWeblink("https://dylanc903.promo-93.codeur.online/")
                   ->setCategory($category)
                   ->setMockup("e3b2dfae701de7b02a8c711c326654aa.png");
                   
            $manager->persist($projet);
        }
        }
        

        $manager->flush();
    }
}
