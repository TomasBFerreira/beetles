<?php 

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Beetle;

class BeetleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $beetle = new Beetle();
            $beetle->setName('Beetle ' . $i);
            $beetle->setGen('Generation ' . $i);
            $beetle->setLineage('Lineage ' . $i);
            $beetle->setSex('M');
            $beetle->setDate(new \DateTime());
            $beetle->setLength('Length ' . $i);

            $manager->persist($beetle);
        }

        $manager->flush();
    }
}
