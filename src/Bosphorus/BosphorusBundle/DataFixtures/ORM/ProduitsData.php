<?php
namespace Bosphorus\BosphorusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bosphorus\BosphorusBundle\Entity\Produits;

class ProduitsData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $produit1 = new Produits();
        $produit1->setCategorie($this->getReference('categorie1'));
        $produit1->setDescription('Bague en argent pur avec ornement forme de coeur, ideal pour votre nouvelle petite amie');
        $produit1->setImage($this->getReference('media1'));
        $produit1->setLargeur('1.7');
        $produit1->setLongueur('2.2');
        $produit1->setNom('Bague Coeur');
        $produit1->setPierre('');
        $produit1->setPierre2('');
        $produit1->setPoids('13');
        $produit1->setPrix('23');
        $produit1->setTva($this->getReference('tva2'));
        $manager->persist($produit1);
        
        $produit2 = new Produits();
        $produit2->setCategorie($this->getReference('categorie1'));
        $produit2->setDescription("Bague en or ornée d'un magnifique diamant 44carat idéal pour demander votre belle en mariage !");
        $produit2->setImage($this->getReference('media2'));
        $produit2->setLargeur('0.4');
        $produit2->setLongueur('0.7');
        $produit2->setNom('Bague fiancaille Or Diamant');
        $produit2->setPierre('diamant');
        $produit2->setPierre2('');
        $produit2->setPoids('4');
        $produit2->setPrix('95');
        $produit2->setTva($this->getReference('tva2'));
        $manager->persist($produit2);
        
        $produit3 = new Produits();
        $produit3->setCategorie($this->getReference('categorie1'));
        $produit3->setDescription("Bague en argent certifié ornée d'un magnifique topas 17 carat un magnifique bijou pour les grande occasions!");
        $produit3->setImage($this->getReference('media3'));
        $produit3->setLargeur('1.5');
        $produit3->setLongueur('2');
        $produit3->setNom('Bague Topaz argent');
        $produit3->setPierre('topaz');
        $produit3->setPierre2('');
        $produit3->setPoids('7');
        $produit3->setPrix('65');
        $produit3->setTva($this->getReference('tva2'));
        $manager->persist($produit3);
        $manager->flush();
        
        $produit4 = new Produits();
        $produit4->setCategorie($this->getReference('categorie2'));
        $produit4->setDescription("Bracelet composer de diamant et d'ornement de rubis en forme de fleur accompagné de perle, un luxe remarqué pour une femme distingué.");
        $produit4->setImage($this->getReference('media4'));
        $produit4->setLargeur('3');
        $produit4->setLongueur('15');
        $produit4->setNom('Bracelet rubis perle diamant');
        $produit4->setPierre('rubis');
        $produit4->setPierre2('diamant');
        $produit4->setPoids('20');
        $produit4->setPrix('110');
        $produit4->setTva($this->getReference('tva2'));
        $manager->persist($produit4);
        $manager->flush();
        
        $produit5 = new Produits();
        $produit5->setCategorie($this->getReference('categorie2'));
        $produit5->setDescription("Bracelet style contemporain ornée de 5 magnifique pierre d'emeraude et en structure d'argent certifié");
        $produit5->setImage($this->getReference('media5'));
        $produit5->setLargeur('2');
        $produit5->setLongueur('18');
        $produit5->setNom('Bracelet Emeraude argent');
        $produit5->setPierre('emeraude');
        $produit5->setPierre2('');
        $produit5->setPoids('8');
        $produit5->setPrix('89');
        $produit5->setTva($this->getReference('tva2'));
        $manager->persist($produit5);
        $manager->flush();
        
        $produit6 = new Produits();
        $produit6->setCategorie($this->getReference('categorie2'));
        $produit6->setDescription("Bracelet style jeune et moderne constitué de grosse pierre de jade rafiné");
        $produit6->setImage($this->getReference('media6'));
        $produit6->setLargeur('4');
        $produit6->setLongueur('17');
        $produit6->setNom('Bracelet jade moderne');
        $produit6->setPierre('jade');
        $produit6->setPierre2('');
        $produit6->setPoids('20');
        $produit6->setPrix('45');
        $produit6->setTva($this->getReference('tva2'));
        $manager->persist($produit6);
        $manager->flush();
        
        $produit7 = new Produits();
        $produit7->setCategorie($this->getReference('categorie1'));
        $produit7->setDescription("Bague en argent certifié ornée d'un magnifique emeraude 35 carats et un ensemble de diamants sur la structure un magnifique bijou pour les grande occasions!");
        $produit7->setImage($this->getReference('media7'));
        $produit7->setLargeur('2');
        $produit7->setLongueur('1.4');
        $produit7->setNom('Bague Emeraude diamant');
        $produit7->setPierre('emeraude');
        $produit7->setPierre2('diamant');
        $produit7->setPoids('6');
        $produit7->setPrix('150');
        $produit7->setTva($this->getReference('tva2'));
        $manager->persist($produit7);
        $manager->flush();
        
        
        $this->addReference('produit1', $produit1);
        $this->addReference('produit2', $produit2);
        $this->addReference('produit3', $produit3);
        $this->addReference('produit4', $produit4);
        $this->addReference('produit5', $produit5);
        $this->addReference('produit6', $produit6);
        $this->addReference('produit7', $produit7);
    }
    
    public function getOrder()
    {
        return 4;
    }
}