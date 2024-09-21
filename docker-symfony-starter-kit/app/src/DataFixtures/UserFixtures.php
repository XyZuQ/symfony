<?php
/**
 *  User fixtures
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserFixtures.
 */
class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @param UserPasswordHasherInterface $passwordHasher passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @param ObjectManager $manager manager
     */
    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user->setEmail('123456@123456.mail');

        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $hashedPassword = $this->passwordHasher->hashPassword($user, '123456');
        $user->setPassword($hashedPassword);

        $manager->persist($user);

        $manager->flush();
    }
}
