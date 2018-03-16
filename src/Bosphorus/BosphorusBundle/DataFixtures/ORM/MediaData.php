<?php
namespace Bosphorus\BosphorusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bosphorus\BosphorusBundle\Entity\Media;

class MediaData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $media1 = new Media();
        $media1->setPath('http://w3.comptoir-irlandais.com/1004-thickbox_default/bague-argent-coeur-celtique.jpg');
        $media1->setAlt('bague argent');        
        $manager->persist($media1);
        
        $media2 = new Media();
        $media2->setPath('http://www.gemperles.com/media/catalog/product/cache/1/image/840x/31313007f87de3991cbd17b12620a3a9/U/p/UpFiles_Image_2010_11_05_634245404279716242_2.jpg');
        $media2->setAlt('bague or');        
        $manager->persist($media2);
        
        $media3 = new Media();
        $media3->setPath('http://media.histoiredor.com/fr/view0size260/B3DFBTB021L.jpg');
        $media3->setAlt('bague topaz');        
        $manager->persist($media3);
        
        $media4 = new Media();
        $media4->setPath('http://www.graal-joaillier.com/img/products/JOBR11135_W_975.jpg');
        $media4->setAlt('bracelet rubis');        
        $manager->persist($media4);
        
        $media5 = new Media();
        $media5->setPath('http://i2.cdscdn.com/pdt2/0/3/3/1/700x700/rev2009967852033/rw/bracelet-femme-argent-emeraude-rond.jpg');
        $media5->setAlt('bracelet emeraude');        
        $manager->persist($media5);
        
        $media6 = new Media();
        $media6->setPath('http://www.peacefulmind.com/images/crystals/jade_bracelet.jpg');
        $media6->setAlt('bracelet jade');        
        $manager->persist($media6);
        
        $media7 = new Media();
        $media7->setPath('http://www.madeinjoaillerie.fr/wp-content/uploads/2012/01/bague-avec-emeraude-cartier.jpg');
        $media7->setAlt('bague emeraude');        
        $manager->persist($media7);
        
        $media8 = new Media();
        $media8->setPath('http://www.compagniedesgemmes.com/visuels/14008378131_bague-chenonceau-saphir-rose-2.png');
        $media8->setAlt('bague saphir');        
        $manager->persist($media8);
        
        $manager->flush();
        
        $this->addReference('media1', $media1);
        $this->addReference('media2', $media2);
        $this->addReference('media3', $media3);
        $this->addReference('media4', $media4);
        $this->addReference('media5', $media5);
        $this->addReference('media6', $media6);
        $this->addReference('media7', $media7);
        $this->addReference('media8', $media8);
    }
    
    public function getOrder()
    {
        return 1;
    }
}