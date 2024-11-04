<?php

namespace App\Controller;
use App\Repository\MaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Materiel;
use Symfony\Component\Validator\Constraints\Date;

class MaterielController extends AbstractController
{
    #[Route('/materiel', name: 'materiel')]
    public function index(MaterielRepository $repo): Response
    {
        $materiels=$repo->findAll();
        return $this->render('materiel/index.html.twig', [
            'materiels' => $materiels
        ]);
    }


    public function create(Request $request, EntityManagerInterface $em): Response
    {     
        $materiel = new Materiel();

        // Handle form submission
        if ($request->isMethod('POST')) {
            $materiel->setNom($request->request->get('nom'));
            $materiel->setType($request->request->get('type'));
            $materiel->setMarque($request->request->get('marque'));
            $materiel->setModele($request->request->get('modele'));
            $materiel->setNumeroSerie($request->request->get('numero_serie'));
            $materiel->setDescription($request->request->get('description'));
            $materiel->setValeurMateriel((int)$request->request->get('valeur_materiel'));
            $materiel->setDisponibilite($request->request->get('disponibilite'));
            $materiel->setEtat($request->request->get('etat'));
            $dateAcquisition = new \DateTimeImmutable($request->request->get('date_acquisition'));
            $materiel->setDateAcquisition($dateAcquisition);
            // Here you can add additional processing for the date if needed

            // Persist the entity
            $em->persist($materiel);
            $em->flush();

            // Redirect or return a response (you might want to redirect to a list page or show a success message)
            return $this->redirectToRoute('materiel'); // Change this to your desired route
        }
        return $this->render('materiel/materiel.html.twig', [
        ]);
    }


    #[Route('/materiel/emperente', name: 'materiel.emperente')]
    public function emperente(EntityManagerInterface $entityManager): Response
    {
        $materiels=$entityManager->getRepository(Materiel::class)->findByDisponibiliteOR('Affecté','En maintenance');
        return $this->render('materiel/materielEm.html.twig', [
                                                             'materiels'=>$materiels
                                                            ]);
    }
    
    public function disponible(EntityManagerInterface $entityManager): Response
    {
        $materiels=$entityManager->getRepository(Materiel::class)->findByDisponibilite('Disponible');
        return $this->render('materiel/materielDis.html.twig', [
                                                                 'materiels'=>$materiels
                                                                ]);
    }
    
    public function edit(Materiel $materiel, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            // Get the form data from the request
            $materiel->setNom($request->request->get('nom'));
            $materiel->setType($request->request->get('type'));
            $materiel->setMarque($request->request->get('marque'));
            $materiel->setModele($request->request->get('modele'));
            $materiel->setNumeroSerie($request->request->get('numero_serie'));
            $materiel->setDateAcquisition(new \DateTimeImmutable($request->request->get('date_acquisition')));
            $materiel->setDisponibilite($request->request->get('disponibilite'));
            $materiel->setEtat($request->request->get('etat'));
            $materiel->setDescription($request->request->get('description'));
            $materiel->setValeurMateriel($request->request->get('valeur_materiel'));

            // Persist changes to database
            $entityManager->flush();

            // Redirect to a specific page (e.g., a list of materiel)
            return $this->redirectToRoute('materiel'); // Update this route as necessary
        }

        // Render the form with existing materiel data
        return $this->render('materiel/edit.html.twig', [
            'materiel' => $materiel,
        ]);
    }
    public function delete(Materiel $materiel, EntityManagerInterface $en){
        $en->remove($materiel);
        $en->flush();
        $this->addFlash('success', 'un  materiel a été supprimé ');
        return $this->redirectToRoute('materiel');


    }
    public function getMaterielById(Materiel $materiel){
        return $this->render('materiel/info.html.twig', [
            'materiel' => $materiel,
        ]);
       
    }
}
