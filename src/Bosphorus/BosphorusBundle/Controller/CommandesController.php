<?php

namespace Bosphorus\BosphorusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Bosphorus\BosphorusBundle\Entity\Commandes;
use Bosphorus\BosphorusBundle\Entity\Produits;
use Bosphorus\BosphorusBundle\Entity\UtilisateursAdresses;

class CommandesController extends Controller {

    public function facture() {
        $em = $this->getDoctrine()->getManager();
        $generator = $this->container->get('security.secure_random');
        $session = $this->getRequest()->getSession();
        $adresse = $session->get('adresse');
        $panier = $session->get('panier');
        $commande = array();
        $totalHT = 0;
        $totalTVA = 0;

        $facturation = $em->getRepository('BosphorusBundle:UtilisateursAdresses')->find($adresse['facturation']);
        $livraison = $em->getRepository('BosphorusBundle:UtilisateursAdresses')->find($adresse['livraison']);
        $produits = $em->getRepository('BosphorusBundle:Produits')->findArray(array_keys($session->get('panier')));

        foreach ($produits as $produit) {
            $prixHT = ($produit->getPrix() * $panier[$produit->getId()]);
            $prixTTC = ($produit->getPrix() * $panier[$produit->getId()] / $produit->getTva()->getMultiplicate());
            $totalHT += $prixHT;

            if (!isset($commande['tva']['%' . $produit->getTva()->getValeur()]))
                $commande['tva']['%' . $produit->getTva()->getValeur()] = round($prixTTC - $prixHT, 2);
            else
                $commande['tva']['%' . $produit->getTva()->getValeur()] += round($prixTTC - $prixHT, 2);
            
            $totalTVA += round($prixTTC - $prixHT,2);
            
            $commande['produit'][$produit->getId()] = array('reference' => $produit->getNom(),
                'quantite' => $panier[$produit->getId()],
                'image' => $produit->getImage(),
                'prixHT' => round($produit->getPrix(), 2),
                'prixTTC' => round($produit->getPrix() / $produit->getTva()->getMultiplicate(), 2));
        }

        $commande['livraison'] = array('prenom' => $livraison->getPrenom(),
            'nom' => $livraison->getNom(),
            'telephone' => $livraison->getTelephone(),
            'adresse' => $livraison->getAdresse(),
            'cp' => $livraison->getCp(),
            'ville' => $livraison->getVille(),
            'pays' => $livraison->getPays(),
            'complement' => $livraison->getComplement());

        $commande['facturation'] = array('prenom' => $facturation->getPrenom(),
            'nom' => $facturation->getNom(),
            'telephone' => $facturation->getTelephone(),
            'adresse' => $facturation->getAdresse(),
            'cp' => $facturation->getCp(),
            'ville' => $facturation->getVille(),
            'pays' => $facturation->getPays(),
            'complement' => $facturation->getComplement());

        $commande['prixHT'] = round($totalHT, 2);
        $commande['prixTTC'] = round($totalHT + $totalTVA, 2);
        $commande['token'] = bin2hex($generator->nextBytes(20));

        return $commande;
    }

    public function prepareCommandeAction() {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();

        if (!$session->has('commande'))
            $commande = new Commandes();
        else
            $commande = $em->getRepository('BosphorusBundle:Commandes')->find($session->get('commande'));

        $commande->setDate(new \DateTime());
        $commande->setUtilisateur($this->container->get('security.context')->getToken()->getUser());
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture());

        if (!$session->has('commande')) {
            $em->persist($commande);
            $session->set('commande', $commande);
        }

        $em->flush();

        return new Response($commande->getId());
    }

    /*
     * Cette methode remplace l'api banque.
     */
    public function validationCommandeAction($id)
    {
         $em = $this->getDoctrine()->getManager();
         $commande = $em->getRepository('BosphorusBundle:Commandes')->find($id);
         
         if (!$commande || $commande->getValider() == 1)
             throw $this->createNotFoundException ('La commande n\'existe pas');
         
         $commande->setValider(1);
         $commande->setReference($this->container->get('setNewReference')->reference()); //Service
         $em->flush();
         
         $session = $this->getRequest()->getSession();
         $session->remove('adresse');
         $session->remove('panier');
         $session->remove('commande');
         
         $this->get('session')->getFlashBag()->add('succes','Votre commande est validé avec succès');
         return $this->redirect($this->generateUrl('factures'));
    }
}
