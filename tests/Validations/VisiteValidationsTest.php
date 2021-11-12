<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Tests\Validations;

use App\Entity\Environnement;
use App\Entity\Visite;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of VisiteValidationsTest
 *
 * @author quens
 */
class VisiteValidationsTest extends KernelTestCase {
    /**
     * 
     * @return Visite
     */
    public function getVisite():Visite
    {
        return (new Visite())->setVille("New York")->setPays("USA");
                
                
    }
    /**
     * permet de tester une note valide
     */
    public function testValidNoteVisite(){
        $visite = $this->getVisite()->setNote(10);
        $this->assertErrors($visite, 0);
    }
     /**
     * permet de tester les notes valides à la limite 
     */
    public function testValidNoteLimiteVisite(){
        $visite = $this->getVisite()->setNote(20);
        $this->assertErrors($visite, 0, "note=20 doit fonctionner");
        $visite = $this->getVisite()->setNote(0);
        $this->assertErrors($visite, 0, "note=0 doit fonctionner");
    }
     /**
     * permet de tester une note non valide
     */
    public function testNonValidNoteLimiteVisite(){
        $visite = $this->getVisite()->setNote(21);
        $this->assertErrors($visite, 1, "note=21 ne doit pas fonctionner");
        $visite = $this->getVisite()->setNote(-1);
        $this->assertErrors($visite, 1, "note=-1 ne doit pas fonctionner");
    }
    /**
     * permet de tester une des température valide
     */
    public function testValidTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(16)
                ->setTempmax(25);
        $this->assertErrors($visite, 0, "min=16, max=25 devrait fonctionner");
    }
    /**
     * permet de tester une des température valide qui se suivent
     */
    public function testValidTempmaxSuiventVisite(){
        $visite = $this->getVisite()
                ->setTempmin(16)
                ->setTempmax(17);
        $this->assertErrors($visite, 0, "min=16, max=17 devrait fonctionner");
    }
    
    /**
     * permet de tester une température non valide
     */
    public function testNonValidTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(20)
                ->setTempmax(18);
        $this->assertErrors($visite, 1, "min=20, max=18 devrait échouer");
    }
    /**
     * permet de tester deux températures identique
     */
    public function testNonValidTempIdentiqueVisite(){
        $visite = $this->getVisite()
                ->setTempmin(20)
                ->setTempmax(20);
        $this->assertErrors($visite, 1, "min=20, max=20 ne devrait pas fonctionner");
    }
    /**
     * permet de tester une date supperieur
     */
    public function testNonValidDatecreationSupperieurVisite(){
        $visite = $this->getVisite()
                ->setDatecreation(new DateTime("2022-01-01"));
        $this->assertErrors($visite, 1, "date=2022-01-01 ne devrait pas fonctionner");
    }
    /**
     * permet de tester si on ne peut pas mettre deux fois le même environnement
     */
    public function testNonValidAjoutEnvPresentVisite(){
        $environnement = new Environnement;
        $environnement->setNom("Montagne");
        $visite = $this->getVisite()
                ->addEnvironnement($environnement)
                ->addEnvironnement($environnement);
        $this->assertErrors($visite, 1, "l'ajout d'un environnement deja présent ne devrait pas fonctionner");
    }
    /**
     * permet de faire le controle d'un objet avec son nombre d'erreurs
     * @param Visite $visite
     * @param int $nbErreurAttentues
     */
    public function assertErrors(Visite $visite, int $nbErreurAttentues, string $message=""){
        self::bootKernel();
        $error = self::$container->get('validator')->validate($visite);
        $this->assertCount($nbErreurAttentues, $error, $message);
    }
}
