<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoueurRepository")
 */
class Joueur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /** 
     * @var string
     * @ORM\Column(length=30)
     * @Assert\NotBlank()
     */
    private $prenom;
    
    /** 
     * @var string
     * @ORM\Column(length=25)
     * @Assert\NotBlank()
     */
    private $nom;
  
    /**
     * @var string
     * @ORM\Column(length=255)
     */
    private $rue;
    
    /**
     * @ORM\Column(length=5,type="string")
     * @var string
     * @Assert\NotBlank()
     */
    private $cp;
    
     /**
     * @var string
     * @ORM\Column(length=30)
     * Assert\NotBlank()
     */
    private $ville;
    
     /**
     * @ORM\Column(unique=true,length=120)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @Assert\Email(message="Cet email n'est pas valide")
     * @var string
     */
    private $mel;
    
    /**
     * @ORM\Column(length=14,type="string")
     * @var string
     * @Assert\NotBlank()
     */
    private $tel1;
    
    /**
    * @ORM\Column(length=14,type="string")
    * @var string
    */
    private $tel2;
    
    /**
     * @var string
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $dateNaissance;
    
     /**
     * @var string
     * @ORM\Column(type="array")
     * @Assert\NotBlank()
     */
    private $genre;
    
     /**
     * @ORM\Column(nullable=true)
     * @Assert\Image()
     * @var string
     */
    private $image;
        
     /**
     * @ORM\Column(nullable=true)
     * @Assert\File(mimeTypes={ "application/pdf" })
     * @var string
     */
    private $certificat;
    
    //CHOIX EQUIPE
     /**
     * @ORM\ManyToOne(targetEntity="Equipe",cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @var Equipe 
      * @Assert\NotBlank()
     */
     private $equipe;   
     

    //CLUB
     /**
     * @ORM\ManyToOne(targetEntity="Club",cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @var Club 
     */
     private $club;


    //GETTERS ET SETTERS
    public function getId() {
        return $this->id;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getRue() {
        return $this->rue;
    }

    public function getCp() {
        return $this->cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getTel1() {
        return $this->tel1;
    }

    public function getTel2() {
        return $this->tel2;
    }

    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setRue($rue) {
        $this->rue = $rue;
        return $this;
    }

    public function setCp($cp) {
        $this->cp = $cp;
        return $this;
    }

    public function setVille($ville) {
        $this->ville = $ville;
        return $this;
    }

    public function setTel1($tel1) {
        $this->tel1 = $tel1;
        return $this;
    }

    public function setTel2($tel2) {
        $this->tel2 = $tel2;
        return $this;
    }

    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    public function getMel() {
        return $this->mel;
    }

    public function getImage() {
        return $this->image;
    }

    public function setMel($mel) {
        $this->mel = $mel;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function getCertificat() {
        return $this->certificat;
    }

    public function setCertificat($certificat) {
        $this->certificat = $certificat;
        return $this;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
        return $this;
    }

    public function getClub(): Club {
        return $this->club;
    }

    public function setClub(Club $club) {
        $this->club = $club;
        return $this;
    }
    public function getEquipe(){
        return $this->equipe;
    }

    public function setEquipe($equipe) {
        $this->equipe = $equipe;
        return $this;
    }

    //affiche le nom et prenom de l utilisateur si il est connecté
    public function getFullname()
    {
        return $this->prenom . ' ' . $this->nom;
    }

}
