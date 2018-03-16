<?php

namespace Bosphorus\BosphorusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Bosphorus\BosphorusBundle\Form\UtilisateursAdressesType;
use Bosphorus\BosphorusBundle\Entity\UtilisateursAdresses;

class PanierController extends Controller
{
     public function supprimerAction($id) {
         $session = $this->getRequest()->getSession();
         $panier = $session->get('panier');
         $this->get('session')->getFlashbag()->add('success','Aricle supprimé avec succès');
         
         if (array_key_exists($id, $panier))
         {
             unset($panier[$id]);
             $session->set('panier', $panier);
         }
         return $this->redirect($this->generateUrl('panier'));
    }

     public function ajouterAction($id) {
         
         $session = $this->getRequest()->getSession();
         
         if (!$session->has('panier')) $session->set('panier',array());
         $panier = $session->get('panier');
         //$panier[ID DU PRODUIT] => quantite
         
         if (array_key_exists($id, $panier)){
             if($this->getRequest()->query->get('qte') != null) $panier[$id] = $this->getRequest()->query->get('qte');
             $this->get('session')->getFlashbag()->add('success','Quantité modifié avec succès');
         } else{
             if($this->getRequest()->query->get('qte') != null)
                 $panier[$id] = $this->getRequest()->query->get('qte');
             else
                 $panier[$id] = 1;
             
             $this->get('session')->getFlashbag()->add('success','Article ajouté avec succès');
         }
         
         $session->set('panier', $panier);
         
        return $this->redirect($this->generateUrl('panier'));
    }

    
     public function panierAction() {
         
         $session = $this->getRequest()->getSession();
         //$session->remove('panier');
         //die();
         if (!$session->has('panier')) $session->set('panier', array()); 
         
         $em = $this->getDoctrine()->getManager();
         $produits = $em->getRepository('BosphorusBundle:Produits')->findArray(array_keys($session->get('panier')));
        return $this->render('BosphorusBundle:Default:panier.html.twig', array('produits' => $produits,
                                                                               'panier' => $session->get('panier')));
    }
    
    public function adresseSuppressionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BosphorusBundle:UtilisateursAdresses')->find($id);
        
        if ($this->container->get('security.context')->getToken()->getUser() != $entity->getUtilisateur() || !$entity)
            return $this->redirect ($this->generateUrl ('livraison'));
        
        $em->remove($entity);
        $em->flush();
        
        return $this->redirect ($this->generateUrl ('livraison'));
    }
    public function livraisonAction() {
        
        $utilisateur = $this->container->get('security.context')->getToken()->getUser();
        $entity = new UtilisateursAdresses();
        $form = $this->createForm(new UtilisateursAdressesType(), $entity);
        
        if ($this->get('request')->getMethod() == 'POST')
        {
            $form->handleRequest($this->getRequest());
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $entity->setUtilisateur($utilisateur);
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('livraison'));
            }
        }
        
        return $this->render('BosphorusBundle:Default:livraison.html.twig', array('utilisateur' =>$utilisateur,
                                                                                  'form' =>$form->createView()));
    }
    
    public function setLivraisonOnSession(){
        
        $session = $this->getRequest()->getSession();
        
        if(!$session->has('adresse')){
             $session->set('adresse',array());
        }
        $adresse = $session->get('adresse');
        
        if ($this->getRequest()->request->get('livraison') != null && $this->getRequest()->request->get('facturation') != null)
        {
            $adresse['livraison'] = $this->getRequest()->request->get('livraison');
            $adresse['facturation'] = $this->getRequest()->request->get('facturation');
        } else {
            return $this->redirect($this->generateUrl('validation'));
        }
        
        $session->set('adresse',$adresse);
        return $this->redirect($this->generateUrl('validation'));
    }
    
     public function validationAction() {
        
         if ($this->get('request')->getMethod() == 'POST'){
            $this->setLivraisonOnSession();
         }
         
         $em = $this->getDoctrine()->getManager();
         $prepareCommande = $this->forward('BosphorusBundle:Commandes:prepareCommande');
         $commande = $em->getRepository('BosphorusBundle:Commandes')->find($prepareCommande->getContent());
         
           
        return $this->render('BosphorusBundle:Default:validation.html.twig', array('commande' => $commande));
    }
    
}
