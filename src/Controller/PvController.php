<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MaterielRepository;
use App\Repository\CollaborateurRepository;
use App\Repository\FournisseurRepository;
use App\Entity\PvAffectation;
use App\Entity\Materiel;
use App\Entity\Fournisseur;
use App\Entity\Collaborateur;
use Doctrine\ORM\EntityManagerInterface;

class PvController extends AbstractController
{
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Get the PvAffectationRepository through EntityManagerInterface
        $pvRepository = $entityManager->getRepository(PvAffectation::class);
        
        // Use the custom repository method to get the data
        $pvAffectations = $pvRepository->findAllWithDetails();
        //dd($pvAffectations);
        
        // Pass the data to the view
        return $this->render('pv/index.html.twig', [
            'pvAffectations' => $pvAffectations,
        ]);
    }

    public function create_collaborateur(MaterielRepository $repoM, CollaborateurRepository $repoC,
                                         Request $request, EntityManagerInterface $entityManager):Response
    {
        
        if($request->isMethod('POST')){
            $collbaorateurId=$request->request->get('collaborateur');
            $materielId=$request->request->get('materiel');
            //dd($collbaorateurId);
            //dd($materielId);
            $startDate = $request->request->get('startDate');
            $endDate = $request->request->get('endDate');
            $reason = $request->request->get('reason');
            $materiel = $entityManager->getRepository(Materiel::class)->find($materielId);
            $collbaorateur = $entityManager->getRepository(Collaborateur::class)->find($collbaorateurId);
            if($collbaorateur && $materiel){
                $materiel->setDisponibilite('Affecté');
                $affectation= new PvAffectation();
                $affectation->setMateriel($materiel);
                $affectation->setcollaborateur($collbaorateur);
                $affectation->setDateDebutAffectation(new \DateTimeImmutable($startDate));
                $affectation->setDateFinAffectation($endDate ? new \DateTimeImmutable($endDate) : null);
                $affectation->setMotifAffectation($reason);
                $entityManager->persist($affectation);
                $entityManager->persist($materiel);       
                $entityManager->flush();
            }
            

         
        }
        $collaborateurs=$repoC->findByStatus('Actif');
        $materiels=$repoM->findByEtatAndDisponibilite('Indéfectueux','Disponible');
        //dd($collaborateurs);
        return $this->render('pv/pvCollab.html.twig', [ 'collaborateurs' => $collaborateurs,
                                                         'materiels' => $materiels
        ]);
    }



    public function create_fournisseur(MaterielRepository $repoM, FournisseurRepository $repoF,
                                       Request $request, EntityManagerInterface $entityManager):Response
    {   
        if($request->isMethod('POST')){
            $fournisseurId=$request->request->get('fournisseur');
            $materielId=$request->request->get('materiel');
            $startDate = $request->request->get('startDate');
            $endDate = $request->request->get('endDate');
            $reason = $request->request->get('reason');
            $materiel = $entityManager->getRepository(Materiel::class)->find($materielId);
            $fournisseur = $entityManager->getRepository(Fournisseur::class)->find($fournisseurId);
            if($fournisseur && $materiel){
                $materiel->setDisponibilite('En maintenance');
                $affectation= new PvAffectation();
                $affectation->setMateriel($materiel);
                $affectation->setFournisseur($fournisseur);
                $affectation->setDateDebutAffectation(new \DateTimeImmutable($startDate));
                $affectation->setDateFinAffectation($endDate ? new \DateTimeImmutable($endDate) : null);
                $affectation->setMotifAffectation($reason);
                $entityManager->persist($affectation);
                $entityManager->persist($materiel);       
                $entityManager->flush();
            }
        }
        
        $fournisseurs=$repoF->findByStatut('Actif');

        $materiels=$repoM->findByEtatAndDisponibilite('Défectueux','Disponible');
        

        return $this->render('pv/pvFour.html.twig', [ 'fournisseurs' => $fournisseurs,
                                                       'materiels'   => $materiels                                  
        ]);
    
}
    public function pv_collaborateur(EntityManagerInterface $entityManager):Response
    {
        $pvRepository = $entityManager->getRepository(PvAffectation::class);
        
        // Use the custom repository method to get the data
        $pvAffectations = $pvRepository->findAllWithDetailsCollab();
        return $this->render('pv/pvCollabListe.html.twig', [
            'pvAffectations' => $pvAffectations,
        ]);
    }
    public function pv_fournisseur(EntityManagerInterface $entityManager):Response
    {
        $pvRepository = $entityManager->getRepository(PvAffectation::class);
        
        // Use the custom repository method to get the data
        $pvAffectations = $pvRepository->findAllWithDetailsFour();
        return $this->render('pv/pvFourListe.html.twig', [ 
            'pvAffectations' => $pvAffectations,
        ]);  
    }
    public function remove():Response
    {
        
        return $this->redirectToRoute('pv');  
    }
    public function info(PvAffectation $pvAffectation):Response
    {

        
        return $this->render('pv/info.html.twig', [
            'pvAffectation'=>$pvAffectation 
        ]);  
    }
}
