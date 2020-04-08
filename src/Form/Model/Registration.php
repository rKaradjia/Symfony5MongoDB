<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Form\Model;
use App\Document\Utilisateurs;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Description of Registration
 *
 * @author rk
 */
class Registration {
    //put your code here
     /**
     * @Assert\Type(type="App\Document\Utilisateurs")
     */
    protected $user;
//@Assert\NotBlank()   @Assert\IsTrue()
   
   // protected $termsAccepted;

    public function setUser(Utilisateurs $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
/*
    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (bool) $termsAccepted;
    }*/
}


    
    

