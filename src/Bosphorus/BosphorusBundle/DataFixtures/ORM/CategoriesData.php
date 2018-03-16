<?php
namespace Bosphorus\BosphorusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bosphorus\BosphorusBundle\Entity\Categories;

class CategoriesData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categories();
        $categorie1->setNom('Bague');
        $categorie1->setImage($this->getReference('media1')); 
        $categorie1->setDescription("Les bijoux les plus prisée des femmes, serti ou non de pierres précieuses.Elle est parfois synonyme de marriage ou simplement d'un grand amour.");
        $manager->persist($categorie1);
       
        $categorie2 = new Categories();
        $categorie2->setNom('Bracelet');
        $categorie2->setImage($this->getReference('media4'));
        $categorie2->setDescription('accessoires de mode très en vogue, notre séléction de bracelet apportera a votre capitale style un plus non négligeable !');
        $manager->persist($categorie2);
        
        $manager->flush();
        
        $this->addReference('categorie1', $categorie1);
        $this->addReference('categorie2', $categorie2);
    }
    
    public function getOrder()
    {
        return 2;
    }
}