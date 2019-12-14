<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user');
        $user->setPassword($this->encoder->encodePassword($user, 'password'));
        $user->setEmail('user@user.com');
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $user->setUsername('admin');
        $user->setPassword($this->encoder->encodePassword($user, 'password'));
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}
