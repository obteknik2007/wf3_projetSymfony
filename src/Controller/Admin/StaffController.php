<?php

namespace App\Controller\Admin;

use App\Entity\Saison;
use App\Entity\Staff;
use App\Form\StaffType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/staff")
 */
class StaffController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Staff::class);
        
        //on recup ts les matchs
        $staffs = $repository->findAll();
        
        return $this->render('admin/staff/index.html.twig', [
            'staffs' => $staffs
        ]);
    }
    
    
    /**
    * @Route("/edit/{id}", defaults={"id":null})
    */
    public function edit(Request $request,$id)
    {
        //entity manager gere les objets et les lignes en bdd
        $em= $this->getDoctrine()->getManager();
        
        if(is_null($id)){
            $staff= new Staff();
            $staff->setClub($this->getUser()->getClub());
            
        } else {
            $staff = $em->getRepository(Staff::class)->find($id);
        }        
        
        //création du formulaire lié à l'équipe
        $form = $this->createForm(StaffType::class, $staff);
        
        //le formulaire traite la requete HTTP
        $form->handleRequest($request);
        
        //si le formulaire à été envoyé
        if ($form->isSubmitted()){
            //s'il n'y à pas d'erreurs de validation du formulaire
            if ($form->isValid()){
                //prepare l'enregistrement en bdd
                $em->persist($staff);
                //fait l'enregistrement en bdd
                $em->flush();
                
                //Ajout du message flash
                $this->addFlash('success', 'Le membre du staff a été enregistré');
                //redirection vers la liste
                return $this->redirectToRoute('app_admin_staff_index');                
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }
        $prenom_nom = $staff->getPrenom().' '.$staff->getNom();
         return $this->render('admin/staff/edit.html.twig', 
                 [
                     'form' => $form->createView(),
                     'prenom_nom' => $prenom_nom
                 ]
        );
    }
    
        /**
     * @Route("/delete/{id}")
     * @param int $id
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $staff = $em->find(Staff::class, $id);
        
        //suppression de la categorie en bdd
        $em->remove($staff);
        $em->flush();
        
        //ajout d'un message
        $this->addFlash('success', 'Le membre du staff a été supprimé');
        //redirection vers la liste des categories
        return $this->redirectToRoute('app_admin_staff_index');
        
    }    
}