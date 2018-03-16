<?php
namespace Utilisateurs\UtilisateursBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bosphorus\BosphorusBundle\Entity\UtilisateursAdresses;

class UtilisateursAdressesData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $adresse1 = new UtilisateursAdresses();
        $adresse1->setUtilisateur($this->getReference('utilisateur1'));
        $adresse1->setNom('Tuna');
        $adresse1->setPrenom('Dylan');
        $adresse1->setTelephone('0651902518');
        $adresse1->setAdresse('12 avenue ledru rollin');
        $adresse1->setCp('94170');
        $adresse1->setPays('France');
        $adresse1->setVille('Perreux-sur-Marne');
        $adresse1->setComplement('4eme étage gauche');
        $manager->persist($adresse1);
        
        $adresse2 = new UtilisateursAdresses();
        $adresse2->setUtilisateur($this->getReference('utilisateur3'));
        $adresse2->setNom('Videira');
        $adresse2->setPrenom('Mickael');
        $adresse2->setTelephone('0600000000');
        $adresse2->setAdresse('33 rue charles ollier');
        $adresse2->setCp('94170');
        $adresse2->setPays('France');
        $adresse2->setVille('Perreux-sur-Marne');
        $adresse2->setComplement('avant derniere maison de la rue');
        $manager->persist($adresse2);
        
        $manager->flush();
        
       // $this->addReference('adresse1', $adresse1);
       // $this->addReference('adresse2', $adresse2);
    }
    
    public function getOrder()
    {
        return 6;
    }
}