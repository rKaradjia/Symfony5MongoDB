<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Document;
/**
 * Description of Utilisateurs
 *
 * @author rk
 */

use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\Document(collection="utilisateurs")
 * @MongoDBUnique(fields="id")
 */

// @Assert\NotBlank() tous sauf id --> ???

class Utilisateurs {
    //put your code here
    
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $nom;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $prenom;

    
    
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    // stupid simple encryption (please don't copy it!)
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    
}
