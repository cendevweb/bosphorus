<?php

namespace Bosphorus\BosphorusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bosphorus\BosphorusBundle\Form\RechercheType;

class ProduitsController extends Controller {

    

    public function categorieAction($categorie) {
        
        $em = $this->getDoctrine()->getManager();
        $findProduits = $em->getRepository('BosphorusBundle:Produits')->byCategorie($categorie);
        $categorie = $em->getRepository('BosphorusBundle:Categories')->find($categorie);
        
        if (!$categorie) throw $this->createNotFoundException('La page n\'existe pas');
        
        $produits = $this->get('knp_paginator')->paginate($findProduits,$this->get('request')->query->get('page', 1),10);
          
        return $this->render('BosphorusBundle:Default:listeproduits.html.twig', array('produits' => $produits));
    }

    public function produitsAction($id) {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        
        $produit = $em->getRepository('BosphorusBundle:Produits')->find($id);
        $produits = $em->getRepository('BosphorusBundle:Produits')->findAll();
        if (!$produit) throw $this->createNotFoundException('La page n\'existe pas');
        
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;
        shuffle($produits);
        return $this->render('BosphorusBundle:Default:produits.html.twig', array('produit' => $produit,
                                                                                 'panier' => $panier,
                                                                                 'produits' => $produits));

    }

   
  /*public function listeProduitsAction($categorie = null) {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        
        if ($categorie != null){
            $findProduits = $em->getRepository('BosphorusBundle:Produits')->byCategorie($categorie);
        }
        else{
              $findProduits = $em->getRepository('BosphorusBundle:Produits')->findBy (array('disponible'=>1));
        }
        
          if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;
        
        $produits = $this->get('knp_paginator')->paginate($findProduits,$this->get('request')->query->get('page', 1),2);
        
         return $this->render('BosphorusBundle:Default:listeroduits.html.twig', array('panier' => $panier,
                                                                                 'produits' => $produits));
  }*/
    public function rechercheAction() {
        $form = $this->createForm(new RechercheType());
        return $this->render('BosphorusBundle:Default:Recherche/modulesUsed/recherche.html.twig', array('form' => $form->createView()));
    }

    public function rechercheTraitementAction() {

        $form = $this->createForm(new RechercheType());
        if ($this->get('request')->getMethod() == 'POST') {
            
            $form->bind($this->get('request'));
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('BosphorusBundle:Produits')->recherche($form['recherche']->getData());
            
            
        }else{
            throw $this->createNotFoundException('La page n\'existe pas');
        }
        
        return $this->render('BosphorusBundle:Default:listeproduits.html.twig', array('produits' => $produits));
    }

}
