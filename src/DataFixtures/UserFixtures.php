<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName('Moussa 3')
            ->setLastName('Sidibe 3')->setRoles(['ROLE_ADMIN'])
            ->setEmail('sidibemousse+3@hotmail.com');


        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            '##########'
        ));
        $manager->persist($user);
        $manager->flush();
    }
}
