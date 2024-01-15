<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\Entity\Beetle;
use App\Entity\Relationship;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BeetleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Create a few families
        for ($f = 0; $f < 5; $f++) {
            $femaleBeetle = new Beetle();
            $femaleBeetle
                ->setName($faker->name)
                ->setGen($faker->randomLetter)
                ->setLineage($faker->word)
                ->setSex('F')
                ->setDate($faker->dateTimeThisYear)
                ->setLength($faker->randomFloat(2, 5, 15) . ' cm');
            $manager->persist($femaleBeetle);

            $maleBeetle = new Beetle();
            $maleBeetle
                ->setName($faker->name)
                ->setGen($faker->randomLetter)
                ->setLineage($faker->word)
                ->setSex('M')
                ->setDate($faker->dateTimeThisYear)
                ->setLength($faker->randomFloat(2, 5, 15) . ' cm');
            $manager->persist($maleBeetle);

            $relationship = new Relationship($femaleBeetle, $maleBeetle);
            $manager->persist($relationship);

            // Create a few children for each family
            for ($c = 0; $c < rand(10, 20); $c++) {
                $childBeetle = new Beetle();
                $childBeetle
                    ->setName($faker->name)
                    ->setGen($faker->randomLetter)
                    ->setLineage($faker->word)
                    ->setSex($faker->randomElement(['M', 'F']))
                    ->setDate($faker->dateTimeThisYear)
                    ->setLength($faker->randomFloat(2, 5, 15) . ' cm')
                    ->setChildOf($relationship);
                $manager->persist($childBeetle);
            }
        }

        $manager->flush();
    }
}
?>