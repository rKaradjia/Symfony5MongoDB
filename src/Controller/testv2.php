<?php

namespace App\Controller;

use App\Form\Model\Registration;
use App\Form\Type\RegistrationType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Document\Utilisateurs;

class testv2 extends AbstractController
{
    public function formbdd(DocumentManager $dm, Request $request)
    {
        $form = $this->createForm(RegistrationType::class, new Registration());
        //Recupération du tableau
        
        $repository = $dm->getRepository(Utilisateurs::class);
        
        //La ligne ci - dessous renvoit un tableau
        $allclient = $repository->findAll();
        
        return $this->render('test/formbdd.html.twig', [
            'form' => $form->createView(),
             'tab' =>  $allclient,
        ]);
    }
    
    public function action(DocumentManager $dm, Request $request){
        
        
    $form = $this->createForm(RegistrationType::class, new Registration());

    $form->handleRequest($request);
    
     var_dump("... Activation des fonctions");
     
   /* $errors = $form['nom']->getErrors();
    $errors2 = $form['prenom']->getErrors();*/
     
    // var_dump("Erreur sur nom " . $errors);
               //     var_dump("Erreur sur prenom " . $errors2);
    foreach ($form->getErrors(true) as $error) {
               echo 'Erreur :  '.$error->getOrigin()->getName().': '.$error->getMessage();
    }

    if ($form->isSubmitted() && $form->isValid()) {
        
        
        
        var_dump("... Traitement en cours");
        
        
        $registration = $form->getData();
        
        
      /*  var_dump($registration);
        var_dump($form->get('user')->getData());*/
        
        $all=$form->get('user')->getData();
        var_dump($all->getNom());
        var_dump($all->getPrenom());
        
        
        if ($form->get('delete')->isClicked()){  
            
            $repository = $dm->getRepository(Utilisateurs::class);
            
            $product = $repository->findOneBy(["nom" => $all->getNom(), "prenom" => $all->getPrenom() ]);
            
            var_dump(gettype($product));
            var_dump($product);
            
            var_dump("Delete");
            
            if($product){
                
                
                $dm->remove($product); 
            
                $dm->flush();
            
            }else{ echo "NOT FOUND";}
            
            }
        
            
            
        if ($form->get('save')->isClicked()){
            
            var_dump("Save");$dm->persist($registration->getUser()); $dm->flush();
            
            //return $this->redirectToRoute('routesubmitsuccess');
        }
        
            
            
        if ($form->get('update')->isClicked()){
                
                var_dump("Update");
                
                
                $repository = $dm->getRepository(Utilisateurs::class);

                $prenom=$all->getNom();
                $nom=$all->getPrenom();
                
                var_dump("Type " . gettype($nom). "  Content " .$nom);
                var_dump("Type " . gettype($prenom). "  Content " . $prenom);
                
                
                $productlist = $repository->findBy([ "nom" => $all->getNom() ]);
                
                var_dump("id - ");
                var_dump($productlist);
                
                
                
                if(count($productlist)>0){
                
                $productlist[0]->setPrenom($all->getPrenom());
                
                 $dm->flush();
                }else{echo "NOT FOUND";}
                 //return $this->redirectToRoute('routesubmitsuccess');
                
        }
        
        
        
        

        
        }else{
                
                
                
                var_dump("NOPE");
            
            
            
            }
    
    
    
    $repository = $dm->getRepository(Utilisateurs::class);
        
        //La ligne ci - dessous renvoit un tableau
        $allclient = $repository->findAll();
        
        return $this->render('test/formbdd.html.twig', [
            'form' => $form->createView(),
             'tab' =>  $allclient,
        ]);

    
    
    
  }

}

