<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\PFE;
use App\Entity\Restau;
use App\Form\PfeType;
use App\Form\RestauType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PfeController extends AbstractController
{
    #[Route('/add', name: 'app_pfe')]
    public function index(Request $request,EntityManagerInterface $manager): Response
    {
        $pfe=new PFE();
        $form=$this->createForm(PfeType::class,$pfe);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $data=$form->getData();
            $manager->persist($data);
            $manager->flush();
            $this->addFlash("success","un nouveau pfe a ete ajoute avec success");
            return $this->redirectToRoute('app_accueil');
        }else{
            return  $this->render("pfe/index.html.twig",[
                'form'=>$form->createView()
            ]);
        }
    }
    /**
     * @Route("/accueil",name="app_accueil")
     */
    public function accueil(ManagerRegistry $doctrine){
        $repository=$doctrine->getRepository(PFE::class);
        $pfes=$repository->findAll();
        return $this->render('pfe/accueil.html.twig',[
            'pfes'=>$pfes
        ]);
    }

    /**
     * @Route("/entreprise",name="app_entreprise")
     */
/*    public function nbreEntreprise(ManagerRegistry $doctrine){
        $repo=$doctrine->getRepository(Entreprise::class);
        $entreprises=$repo->findAll();
        return $this->render('pfe/affichage.html.twig',[
            'entreprises'=>$entreprises
        ]);
    }
*/
    /**
     * @Route ("/affichage",name="app_affichage")
     */
    public function affichage(ManagerRegistry $doctrine){
        $repository=$doctrine->getRepository(PFE::class);
        $entreprises=$repository->findByPFE();
        return $this->render('pfe/affichage.html.twig',[
            'entreprises'=>$entreprises,

        ]);
    }


}
