<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Materiel;
use App\Entity\Collaborateur;
use App\Entity\Fournisseur;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function index(): Response
    {
        $collab=$this->em->getRepository(Collaborateur::class)->CountCollaborateur();
        $four=$this->em->getRepository(Fournisseur::class)->CountFournisseur();
        $mat=$this->em->getRepository(Materiel::class)->CountMateriel();
        $matAff=$this->em->getRepository(Materiel::class)->CountMaterielBydispo('Affecté');
        $matMan=$this->em->getRepository(Materiel::class)->CountMaterielBydispo('En maintenance');
        $matEtat=$this->em->getRepository(Materiel::class)->CountMaterielByEtat('Indéfectueux');
        return $this->render('home/index.html.twig', [ 'collab'=> $collab,
                                                        'four'=> $four,
                                                        'mat'=> $mat,
                                                        'matAff'=> $matAff,
                                                        'matMan'=> $matMan, 
                                                        'matEtat'=>$matEtat,          
        ]);
    }
    public function login(): Response
    {
        return $this->render('home/login.html.twig', [
        ]);
    }

}
