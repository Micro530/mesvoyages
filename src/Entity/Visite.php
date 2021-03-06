<?php

namespace App\Entity;

use App\Repository\VisiteRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=VisiteRepository::class)
 * @Vich\Uploadable
 */
class Visite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pays;

    /**
     * @Assert\Range(max="now")
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecreation;

    /**
     * @Assert\Range(min = 0, max = 20)
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avis;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tempmin;
    
    /**
     * @Assert\GreaterThan(propertyPath="tempmin")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tempmax;

    /**
     * @ORM\ManyToMany(targetEntity=Environnement::class)
     */
    private $environnements;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="visites", fileNameProperty="imageName")
     * @Assert\Image{mimeTypes="image/jpeg"}
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $uploaded_at;

    public function __construct()
    {
        $this->environnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getDatecreation(): ?DateTimeInterface
    {
        return $this->datecreation;
    }
    
    public function getDatecreationString(): string
    {
        //return $this->datecreation->format('dd/mm/yyyy');
        return $this->datecreation->format('d/m/Y');
    }

    public function setDatecreation(?DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(?string $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getTempmin(): ?int
    {
        return $this->tempmin;
    }

    public function setTempmin(?int $tempmin): self
    {
        $this->tempmin = $tempmin;

        return $this;
    }

    public function getTempmax(): ?int
    {
        return $this->tempmax;
    }

    public function setTempmax(?int $tempmax): self
    {
        $this->tempmax = $tempmax;

        return $this;
    }

    /**
     * @return Collection|Environnement[]
     */
    public function getEnvironnements(): Collection
    {
        return $this->environnements;
    }

    public function addEnvironnement(Environnement $environnement): self
    {
        if (!$this->environnements->contains($environnement)) {
            $this->environnements[] = $environnement;
        }

        return $this;
    }

    public function removeEnvironnement(Environnement $environnement): self
    {
        $this->environnements->removeElement($environnement);

        return $this;
    }
    function getImageFile(): ?File {
        return $this->imageFile;
    }

    function getImageName(): ?string {
        return $this->imageName;
    }

    function setImageFile(?File $imageFile): self {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof \Symfony\Component\HttpFoundation\File\UploadedFile)
        {
            $this->uploaded_at = new \DateTime('now'); 
        }
        return $this;
    }

    function setImageName(?string $imageName): self {
        $this->imageName = $imageName;
        return $this;
    }

    public function getUploadedAt(): ?\DateTimeImmutable
    {
        return $this->uploaded_at;
    }

    public function setUploadedAt(?\DateTimeImmutable $uploaded_at): self
    {
        $this->uploaded_at = $uploaded_at;

        return $this;
    }


}
