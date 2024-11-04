<?php

namespace App\Controller;
use App\Repository\FournisseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Fournisseur;
class FournisseurController extends AbstractController
{
    public function index(FournisseurRepository $repo): Response
    {
        $fournisseurs=$repo->findAll();
        return $this->render('fournisseur/index.html.twig', [
            'fournisseurs' => $fournisseurs,
        ]);
    }
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Initialize the Fournisseur object
        $fournisseurs = new Fournisseur();

        // Check if the request is a POST request
        if ($request->isMethod('POST')) {
            // Set the properties based on the submitted form data
            $fournisseurs->setNomEntreprise($request->request->get('companyName'));
            $fournisseurs->setContactPrincipal($request->request->get('contactPerson'));
            $fournisseurs->setAdresse($request->request->get('address'));
            $fournisseurs->setTelephone($request->request->get('phone'));
            $fournisseurs->setEmail($request->request->get('email'));
            $fournisseurs->setTypeService($request->request->get('serviceType'));
            $fournisseurs->setStatut($request->request->get('statut'));

            // Enregistrez le fournisseur dans la base de données
            $entityManager->persist($fournisseurs);
            $entityManager->flush();
            $this->addFlash('success', 'Fournisseur ajouté avec succès!');
             return $this->redirectToRoute('fournisseur'); 
        }
        
        // Render the form template with the current fournisseur data
        return $this->render('fournisseur/fournisseur.html.twig', [
        ]);
    }
    public function edit(Fournisseur $fournisseur, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            // Get the form data from the request
            $fournisseur->setNomEntreprise($request->request->get('companyName'));
            $fournisseur->setContactPrincipal($request->request->get('contactPerson'));
            $fournisseur->setAdresse($request->request->get('address'));
            $fournisseur->setTelephone($request->request->get('phone'));
            $fournisseur->setEmail($request->request->get('email'));
            $fournisseur->setTypeService($request->request->get('serviceType'));
            $fournisseur->setStatut($request->request->get('statut'));

            // Persist changes to database
            $entityManager->flush();

            // Redirect to a specific page (e.g., a list of fournisseur)
            return $this->redirectToRoute('fournisseur'); // Update this route as necessary
        }

        // Render the form with existing fournisseur data
        return $this->render('fournisseur/edit.html.twig', [
            'fournisseur' => $fournisseur,
        ]);
    }
    public function delete(Fournisseur $fournisseur, EntityManagerInterface $en){
        $en->remove($fournisseur);
        $en->flush();
        $this->addFlash('success', 'un  fournisseur a été supprimé ');
        return $this->redirectToRoute('fournisseur');


    }
    public function getFournisseurById(Fournisseur $fournisseur){
        return $this->render('fournisseur/info.html.twig', [
            'fournisseur' => $fournisseur,
        ]);
       
    }
}

