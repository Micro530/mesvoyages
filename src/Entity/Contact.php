<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Symfony\Component\Validator\Constraints as Assert;

namespace App\Entity;

/**
 * Description of Contact
 *
 * @author quens
 */
class Contact {
    /**
     * 
     * @var string|null
     * @Symfony\Component\Validator\Constraints\NotBlank()
     * @Symfony\Component\Validator\Constraints\Length(min=2, max=100)
     */
    private $nom;
    /**
     * 
     * @var string|null
     * @Symfony\Component\Validator\Constraints\NotBlank()
     * @Symfony\Component\Validator\Constraints\Email()
     */
    private $email;
    /**
     * 
     * @var string|null
     * @Symfony\Component\Validator\Constraints\NotBlank()
     */
    private $message;
    function getNom(): ?string {
        return $this->nom;
    }

    function getEmail(): ?string {
        return $this->email;
    }

    function getMessage(): ?string {
        return $this->message;
    }

    function setNom(?string $nom): self {
        $this->nom = $nom;
        return $this;
    }

    function setEmail(?string $email): self {
        $this->email = $email;
        return $this;
    }

    function setMessage(?string $message): self {
        $this->message = $message;
        return $this;
    }

  
}
