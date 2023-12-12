<?php 

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Beetle;
use App\Entity\Relationship;

class BeetleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $femaleBeetle = new Beetle();
        $femaleBeetle
            ->setName('Female Beetle')
            ->setGen('Gen A')
            ->setLineage('Lineage 1')
            ->setSex('F')
            ->setDate(new \DateTime())
            ->setLength('10 cm');
        $manager->persist($femaleBeetle);

        $maleBeetle = new Beetle();
        $maleBeetle
            ->setName('Male Beetle')
            ->setGen('Gen A')
            ->setLineage('Lineage 1')
            ->setSex('M')
            ->setDate(new \DateTime())
            ->setLength('8 cm');
        $manager->persist($maleBeetle);

        $relationShip = new Relationship($femaleBeetle, $maleBeetle);
        $childBeetle = new Beetle();
        $childBeetle
            ->setName('Child Beetle')
            ->setGen('Gen B')
            ->setLineage('Lineage 1')
            ->setSex('M') 
            ->setDate(new \DateTime())
            ->setLength('5 cm')
            ->setChildOf($relationShip); 
        $manager->persist($relationShip);
        $manager->persist($childBeetle);

        $femaleBeetle2 = new Beetle();
        $femaleBeetle2
            ->setName('Female Beetle 2')
            ->setGen('Gen A')
            ->setLineage('Lineage 2')
            ->setSex('M')
            ->setDate(new \DateTime())
            ->setLength('9 cm');
        $manager->persist($femaleBeetle2);
        $relationShip = new Relationship($femaleBeetle2, $maleBeetle);
        $manager->persist($relationShip);

        $manager->flush();
    }
}
