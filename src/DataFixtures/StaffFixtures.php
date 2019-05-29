<?php


namespace App\DataFixtures;




use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Staff;
use Faker;



class StaffFixtures extends Fixture

{


    public function load(ObjectManager $em)
    {
        // initialisation de l'objet Faker
        $faker = Faker\Factory::create('fr_FR');

        // créations du staff

        for ($i=0; $i < 30; $i++) {


            $staffs = new Staff();
            $staffs->setName($faker->company);
            $staffs->setLastName($faker->name);
            $staffs->setImgHead($faker->name);
            $staffs->setPoste($faker->address);

            $em->persist($staffs);
        }



        $em->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
