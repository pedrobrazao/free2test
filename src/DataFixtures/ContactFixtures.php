<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('en_GB');

        for ($i = 0; $i < random_int(1000, 2000); $i++) {
            $rand = random_int(1, 40);

            if ($rand <= 20) {
                $salutation = 'Mr';
                $gender = 'M';
                $dob = $faker->dateTimeBetween('-70 years', '-16 years');
                $firstName = $faker->firstNameMale;
            } elseif ($rand <= 30) {
                $salutation = 'Mr';
                $gender = 'F';
                $dob = $faker->dateTimeBetween('-30 years', '-16 years');
                $firstName = $faker->firstNameFemale;
            } elseif ($rand <= 40) {
                $salutation = 'Ms';
                $gender = 'F';
                $dob = $faker->dateTimeBetween('-70 years', '-30 years');
                $firstName = $faker->firstNameFemale;
            }

            $lastName = $faker->lastName;
            $address = 90 > random_int(0, 100) ? $faker->streetAddress : null;
            $city = $faker->city;
            $postcode = $faker->postcode;
            $email = strtolower(substr($firstName, 0, 1) . $lastName . '@' . $faker->safeEmailDomain);
            $password = $faker->password;

            $contact = (new Contact())
                    ->setSalutation($salutation)
                    ->setGender($gender)
                    ->setDob($dob)
                    ->setFirstName($firstName)
                    ->setLastName($lastName)
                    ->setAddress($address)
                    ->setCity($city)
                    ->setPostcode($postcode)
                    ->setEmail($email)
                    ->setPassword($password);

            $manager->persist($contact);
        }

        $manager->flush();
    }

}
