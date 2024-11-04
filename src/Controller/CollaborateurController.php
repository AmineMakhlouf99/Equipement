<?php

namespace App\Controller;
use App\Repository\CollaborateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Collaborateur;
use Symfony\Component\Validator\Constraints\Date;
class CollaborateurController extends AbstractController
{
   
    public function index(CollaborateurRepository $repo): Response
    {
        $collaborateurs=$repo->findAll();
        return $this->render('collaborateur/index.html.twig', [
            'collaborateurs' => $collaborateurs
        ]);
    }
    public function create(Request $request, EntityManagerInterface $em): Response
    {
          $collaborateur=new Collaborateur();
        if ($request->isMethod('POST')) {
            $firstName = $request->request->get('firstName');
            $lastName = $request->request->get('lastName');
            $position = $request->request->get('position');
            $department = $request->request->get('department');
            $email = $request->request->get('email');
            $phone = $request->request->get('phone');
            $hireDate = $request->request->get('hireDate');

            $hireDate =new \DateTimeImmutable($hireDate);

            $status = $request->request->get('status');
           $collaborateur->setPrenom($firstName);
           $collaborateur->setNom($lastName);
           $collaborateur->setPoste($position);
           $collaborateur->setDepartement($department);
           $collaborateur->setEmail($email);
           $collaborateur->setTelephone($phone);
           $collaborateur->setDateEmbauche($hireDate);
           $collaborateur->setStatus($status);
           $em->persist($collaborateur);
           $em->flush();
            $this->addFlash('success', 'Collaborateur ajouté avec succès!');
             return $this->redirectToRoute('collaborateur'); 


        }
        return $this->render('collaborateur/collaborate.html.twig', [
        ]);
    }
    public function edit(Collaborateur $collaborateur, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            // Get the form data from the request
            $firstName = $request->request->get('firstName');
            $lastName = $request->request->get('lastName');
            $position = $request->request->get('position');
            $department = $request->request->get('department');
            $email = $request->request->get('email');
            $phone = $request->request->get('phone');
            $hireDate = $request->request->get('hireDate');

            $hireDate =new \DateTimeImmutable($hireDate);

            $status = $request->request->get('status');
           $collaborateur->setPrenom($firstName);
           $collaborateur->setNom($lastName);
           $collaborateur->setPoste($position);
           $collaborateur->setDepartement($department);
           $collaborateur->setEmail($email);
           $collaborateur->setTelephone($phone);
           $collaborateur->setDateEmbauche($hireDate);
           $collaborateur->setStatus($status);

            // Persist changes to database
            $entityManager->flush();

            // Redirect to a specific page (e.g., a list of collaborateur)
            return $this->redirectToRoute('collaborateur'); // Update this route as necessary
        }

        // Render the form with existing collaborateur data
        return $this->render('collaborateur/edit.html.twig', [
            'collaborateur' => $collaborateur,
        ]);
    }
    public function delete(Collaborateur $collaborateur, EntityManagerInterface $en){
        $en->remove($collaborateur);
        $en->flush();
        $this->addFlash('success', 'un  collaborateur a été supprimé ');
        return $this->redirectToRoute('collaborateur');


    }
    public function getCollaborateurById(Collaborateur $collaborateur){
        return $this->render('collaborateur/info.html.twig', [
            'collaborateur' => $collaborateur,
        ]);
       
    }
}
