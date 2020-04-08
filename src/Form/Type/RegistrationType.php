<?php

// src/Form/Type/RegistrationType.php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Document\Utilisateurs;




class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', UtilisateurType::class);
        $builder->add('save', SubmitType::class/*, ['property_path' => 'termsAccepted']*/);
        $builder->add('update', SubmitType::class);
        $builder->add('delete', SubmitType::class);
        
        
        
    }
}