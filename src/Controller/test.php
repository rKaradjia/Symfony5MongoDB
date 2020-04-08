<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author rk
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Document\Utilisateurs;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ODM\MongoDB\DocumentManager;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class test extends AbstractController{
    //put your code here
    
    public function formbdd(Request $request,DocumentManager $dm)
    {

        $task = new Utilisateurs();
        $task->setNom('Saisir');
        $task->setPrenom('Saisir');
        
        
       // $this->container->get('security.csrf.token_manager');
        
        $form = $this->createFormBuilder($task)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('save', SubmitType::class/*, ['label' => 'Create Task']*/)
            ->add('update', SubmitType::class)    
            ->add('delete', SubmitType::class)    
                ->getForm();
        
        var_dump('avant le isSubmitted()');
        //$form->submit($request);
        //$form->handleRequest($request);
        $form->submit($request->request->all());
       
          $errors = $form['nom']->getErrors();
                    $errors2 = $form['prenom']->getErrors();
                    // $errorOrigine=$form->getErrors(true)->getOrigin();
        
                    //
                    var_dump("Erreur sur nom " . $errors);
                    var_dump("Erreur sur prenom " . $errors2);
                    foreach ($form->getErrors(true) as $error) {
                            echo '* '.$error->getOrigin()->getName().': '.$error->getMessage();
                    }
                 
        
        //$submittedToken = $request->request->get('token');
        
        
     //   if ($this->isCsrfTokenValid('action', $submittedToken)) {
        // ... do something, like deleting an object
              var_dump("CSRF validé");
              
              
              var_dump("Bouton save clique " . $form->get('save')->isClicked());
                     
        if ($form->isSubmitted() /*&& $form->isValid() */&& $form->get('save')->isClicked()) {
                 //recuperation des données saisies dans les champs
                 
                var_dump("Le formulaire rendu est valide"); 

                    $nom=$form->get('nom')->getData();
                    $prenom=$form->get('prenom')->getData();
                    
                 
                if($nom!="" && $prenom!=""){       
                    
                    $user = new Utilisateurs();//en lien direct avec l'entite
                    $user->setNom($form->get('nom')->getData());
                    $user->setPrenom($form->get('prenom')->getData());
                   
                    $dm->persist($user);
                    var_dump( $dm->persist($user));
               
                    // actually executes the queries (i.e. the INSERT query)
                    $dm->flush();
                    var_dump($dm->flush());

                     var_dump('Saved new product with id '.$user->getId());
                
                
                    //La ligne ci dessous permet d'eviter 
                    //les envois multiples 
                    return $this->redirectToRoute('routesubmitsuccess');
                    //return new Response('Saved new product with id '.$client->getId());
                } else { var_dump("Le formulaire rendu est invalide BIS"); }
        }else{
                 
                 var_dump("Le formulaire rendu est invalide");
                 
                
                 
                 
                 
                 
        }
        
       // }
        
        
        
        var_dump($form->isSubmitted());
        var_dump($form->isValid());
        
        
        $repository = $dm->getRepository(Utilisateurs::class);
        
        //La ligne ci - dessous renvoit un tableau
        $allclient = $repository->findAll();
        
        
        return $this->render('test/formbdd.html.twig', [
            'form' => $form->createView(),
            'tab' =>  $allclient,
        ]);
        
    }    
}
