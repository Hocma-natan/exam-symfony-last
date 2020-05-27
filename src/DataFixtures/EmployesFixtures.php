<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Employe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EmployesFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    // ...
    public function load(ObjectManager $manager)
    {
        $employe = new Employe();
        $employe->setSecteur('Direction');
        $employe->setEmail('admin@deloitte.com');
        $employe->setNom('admin');
        $employe->setPrenom('admin');
        $employe->setPhoto('img/avatar.png');
        $employe->setRoles(['ROLE_ADMIN']);
    
        $password = $this->encoder->encodePassword($employe, 'admin123@');
        $employe->setPassword($password);
    
        $manager->persist($employe);
        $manager->flush();


        $employe = new Employe();
        $employe->setSecteur('Recrutement');
        $employe->setEmail('rec@deloitte.com');
        $employe->setNom('Rh');
        $employe->setPrenom('Rh');
        $employe->setPhoto('img/rh.png');
        $employe->setRoles(['ROLE_RECRUTEMENT']);
    
        $password = $this->encoder->encodePassword($employe, 'recrutement123@');
        $employe->setPassword($password);
    
        $manager->persist($employe);
        $manager->flush();


        $employe = new Employe();
        $employe->setSecteur('Informatique');
        $employe->setEmail('info@deloitte.com');
        $employe->setNom('Informatique');
        $employe->setPrenom('Informatique');
        $employe->setPhoto('img/info.png');
        $employe->setRoles(['ROLE_INFORMATIQUE']);
    
        $password = $this->encoder->encodePassword($employe, 'info123@');
        $employe->setPassword($password);
    
        $manager->persist($employe);
        $manager->flush();

    }
}