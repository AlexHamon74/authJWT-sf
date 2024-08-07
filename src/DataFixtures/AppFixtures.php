<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const CATEGORIES = [
        [
            'name' => 'Sport',
            'image' => 'sport.png'
        ],
        [
            'name' => 'Voyage',
            'image' => 'voyage.png'
        ]
    ];

    
    public function load(ObjectManager $manager): void
    {
        $generator = \Faker\Factory::create();
        
        // Ajout des Users
        $regularUser = new User();
        $regularUser->setEmail('bob@test.com')
        ->setRoles(['ROLE_USER'])
        ->setPassword('bob1234')
        ->setName('Bob');
        
        $adminUser = new User();
        $adminUser->setEmail('admin@test.com')
        ->setRoles(['ROLE_ADMIN'])
        ->setPassword('admin1234')
        ->setName('Admin');
        
        $manager->persist($regularUser);
        $manager->persist($adminUser);
        
        
        //Tableau pour stocker les catégories
        $categories = [];

        //Ajout des catégories
        foreach (self::CATEGORIES as $categoryData) {
            $category = new Category();
            $category->setName($categoryData['name'])
                ->setImage($categoryData['image']);

            $manager->persist($category);
            $categories[$categoryData['name']] = $category;
        }


        //Ajout des items
        for ($i = 0; $i < 5; $i++) {
            $article = new Article();
            $article->setName($generator->name())
                ->setDescription($generator->realTextBetween(200, 250))
                ->setCategory($categories[array_rand($categories)]);

            $manager->persist($article);
        }

        $manager->flush();
    }
}
