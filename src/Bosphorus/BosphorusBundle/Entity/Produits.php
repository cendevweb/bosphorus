<?php

namespace Bosphorus\BosphorusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table("produits")
 * @ORM\Entity(repositoryClass="Bosphorus\BosphorusBundle\Repository\ProduitsRepository")
 */
class Produits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\OneToOne(targetEntity="Bosphorus\BosphorusBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bosphorus\BosphorusBundle\Entity\Categories", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;
    
     /**
     * @ORM\ManyToOne(targetEntity="Bosphorus\BosphorusBundle\Entity\Tva", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tva;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="pierre", type="string", length=125)
     */
    private $pierre;

    /**
     * @var string
     *
     * @ORM\Column(name="pierre2", type="string", length=125)
     */
    private $pierre2;

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float")
     */
    private $poids;

    /**
     * @var float
     *
     * @ORM\Column(name="longueur", type="float")
     */
    private $longueur;

    /**
     * @var float
     *
     * @ORM\Column(name="largeur", type="float")
     */
    private $largeur;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Produits
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produits
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produits
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set pierre
     *
     * @param string $pierre
     *
     * @return Produits
     */
    public function setPierre($pierre)
    {
        $this->pierre = $pierre;

        return $this;
    }

    /**
     * Get pierre
     *
     * @return string
     */
    public function getPierre()
    {
        return $this->pierre;
    }

    /**
     * Set pierre2
     *
     * @param string $pierre2
     *
     * @return Produits
     */
    public function setPierre2($pierre2)
    {
        $this->pierre2 = $pierre2;

        return $this;
    }

    /**
     * Get pierre2
     *
     * @return string
     */
    public function getPierre2()
    {
        return $this->pierre2;
    }

    /**
     * Set poids
     *
     * @param float $poids
     *
     * @return Produits
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return float
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set longueur
     *
     * @param float $longueur
     *
     * @return Produits
     */
    public function setLongueur($longueur)
    {
        $this->longueur = $longueur;

        return $this;
    }

    /**
     * Get longueur
     *
     * @return float
     */
    public function getLongueur()
    {
        return $this->longueur;
    }

    /**
     * Set largeur
     *
     * @param float $largeur
     *
     * @return Produits
     */
    public function setLargeur($largeur)
    {
        $this->largeur = $largeur;

        return $this;
    }

    /**
     * Get largeur
     *
     * @return float
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * Set image
     *
     * @param \Bosphorus\BosphorusBundle\Entity\Media $image
     *
     * @return Produits
     */
    public function setImage(\Bosphorus\BosphorusBundle\Entity\Media $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Bosphorus\BosphorusBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set categorie
     *
     * @param \Bosphorus\BosphorusBundle\Entity\Categories $categorie
     *
     * @return Produits
     */
    public function setCategorie(\Bosphorus\BosphorusBundle\Entity\Categories $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Bosphorus\BosphorusBundle\Entity\Categories
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set tva
     *
     * @param \Bosphorus\BosphorusBundle\Entity\Tva $tva
     *
     * @return Produits
     */
    public function setTva(\Bosphorus\BosphorusBundle\Entity\Tva $tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return \Bosphorus\BosphorusBundle\Entity\Tva
     */
    public function getTva()
    {
        return $this->tva;
    }
}
