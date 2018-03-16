<?php

namespace Bosphorus\BosphorusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function menuAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('BosphorusBundle:Categories')->findAll();
        
        if (!$session->has('panier')) $session->set('panier', array());
       $emPanier = $this->getDoctrine()->getManager();
       $contentPanier = $emPanier->getRepository('BosphorusBundle:Produits')->findArray(array_keys($session->get('panier')));
        
        return $this->render('BosphorusBundle:Default:modulesUsed/menu.html.twig', array('categories'=>$categories,
                                                                                         'contentPanier' => $contentPanier,
                                                                                         'panier' => $session->get('panier')));
    }
    
    public function indexAction() {
       $em = $this->getDoctrine()->getManager();
       $categories = $em->getRepository('BosphorusBundle:Categories')->findAll();
       $produits = $em->getRepository('BosphorusBundle:Produits')->findAll();
       $produits2 = $em->getRepository('BosphorusBundle:Produits')->findAll();
       shuffle($produits);
       shuffle($produits2);
       return $this->render('BosphorusBundle:Default:index.html.twig', array('categories'=>$categories,
                                                                              'produits'=>$produits,
                                                                              'produits2'=>$produits2));
    }
}
