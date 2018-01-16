<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Tags;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductsRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\UploaderBundle\Mapping\Annotation\Uploadable
 */
class Products {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="text")
     * @Assert\NotBlank()
     */
    private $descrizione;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_creazione", type="datetime")
     */
    private $dataCreazione;

    /**
     * @var Tag[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Tags", cascade={"persist"})
     * @ORM\JoinTable(name="products_tags")
     * 
     */
    private $tags;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploaderBundle\Mapping\Annotation\UploadableField(mapping="product_image", fileNameProperty="imageName", size="imageSize")
     * @Assert\File(
     *     maxSize = "1M",
     *     mimeTypes = {
     *              "image/jpeg",
     *              "image/png",
     *     },
     *     mimeTypesMessage = "Please upload a valid image"
     * )
     * @Assert\NotBlank(groups={"create"})
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @param File|UploadedFile $image
     */
    public function setImageFile(?File $image = null): void {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    /**
     * 
     * @return File|null
     */
    public function getImageFile(): ?File {
        return $this->imageFile;
    }

    /**
     * 
     * @param string|null $imageName
     * @return void
     */
    public function setImageName(?string $imageName): void {
        $this->imageName = $imageName;
    }

    /**
     * 
     * @return string|null
     */
    public function getImageName(): ?string {
        return $this->imageName;
    }

    /**
     * 
     * @param int|null $imageSize
     * @return void
     */
    public function setImageSize(?int $imageSize): void {
        $this->imageSize = $imageSize;
    }

    /**
     * 
     * @return int|null
     */
    public function getImageSize(): ?int {
        return $this->imageSize;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nome.
     *
     * @param string $nome
     *
     * @return Products
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome.
     *
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Set descrizione.
     *
     * @param string $descrizione
     *
     * @return Products
     */
    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * Get descrizione.
     *
     * @return string
     */
    public function getDescrizione() {
        return $this->descrizione;
    }

    /**
     * Set immagine.
     *
     * @param string $immagine
     *
     * @return Products
     */
    public function setImmagine($immagine) {
        $this->immagine = $immagine;

        return $this;
    }

    /**
     * Get immagine.
     *
     * @return string
     */
    public function getImmagine() {
        return $this->immagine;
    }

    /**
     * Triggered on insert
     * @ORM\PrePersist
     */
    public function onPrePersist() {
        $this->dataCreazione = new \DateTime("now");
    }

    /**
     * Set dataCreazione.
     *
     * @param DateTime $dataCreazione
     *
     * @return Products
     */
    public function setDataCreazione($dataCreazione) {

        $this->dataCreazione = $dataCreazione;

        return $this;
    }

    /**
     * Get dataCreazione.
     *
     * @return DateTime
     */
    public function getDataCreazione() {
        return $this->dataCreazione;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->tags = new ArrayCollection();
    }

    /**
     * Add tag.
     *
     * @param Tags $tag
     *
     * @return Products
     */
    public function addTag(Tags $tag) {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag.
     *
     * @param Tags $tag
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTag(Tags $tag) {
        return $this->tags->removeElement($tag);
    }

    /**
     * Get tags.
     *
     * @return Collection
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Products
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

}
