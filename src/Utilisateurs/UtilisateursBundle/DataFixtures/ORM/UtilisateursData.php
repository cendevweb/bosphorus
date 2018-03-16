<?php
namespace Utilisateurs\UtilisateursBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Utilisateurs\UtilisateursBundle\Entity\Utilisateurs;

class UtilisateursData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;
    
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    public function load(ObjectManager $manager)
    {
      $utilisateur1 = new Utilisateurs();
      $utilisateur1->setUsername('dylan');
      $utilisateur1->setEmail('tuna.dylan@gmail.com');
      $utilisateur1 ->setEnabled(1);
      $utilisateur1 ->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur1)->encodePassword('dylan', $utilisateur1->getSalt()));
      $manager->persist($utilisateur1);
      
      $utilisateur2 = new Utilisateurs();
      $utilisateur2->setUsername('papa');
      $utilisateur2->setEmail('papa.papa@gmail.com');
      $utilisateur2 ->setEnabled(1);
      $utilisateur2 ->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur2)->encodePassword('papa', $utilisateur2->getSalt()));
      $manager->persist($utilisateur2);
      
      $utilisateur3 = new Utilisateurs();
      $utilisateur3->setUsername('client');
      $utilisateur3->setEmail('client.client.com');
      $utilisateur3 ->setEnabled(1);
      $utilisateur3 ->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur3)->encodePassword('client', $utilisateur3->getSalt()));
      $manager->persist($utilisateur3);
      
      $utilisateur4 = new Utilisateurs();
      $utilisateur4->setUsername('admin');
      $utilisateur4->setEmail('admin.admin@gmail.com');
      $utilisateur4 ->setEnabled(1);
      $utilisateur4 ->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur4)->encodePassword('admin', $utilisateur4->getSalt()));
      $manager->persist($utilisateur4);
      
      $manager->flush();
      
      $this->addReference('utilisateur1', $utilisateur1);
      $this->addReference('utilisateur2', $utilisateur2);
      $this->addReference('utilisateur3', $utilisateur3);
      $this->addReference('utilisateur4', $utilisateur4);
    }
    
    public function getOrder()
    {
        return 5;
    }
}