<?php

namespace App\Entity;

use App\Repository\RecordPhotosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecordPhotosRepository::class)]
class RecordPhotos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recordPhotos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Record $record_id = null;

    #[ORM\Column(length: 255)]
    private ?string $photoName = null;

    #[ORM\Column(length: 255)]
    private ?string $photoUrlName = null;

    #[ORM\Column(length: 512)]
    private ?string $photoMediaPath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecordId(): ?Record
    {
        return $this->record_id;
    }

    public function setRecordId(?Record $record_id): self
    {
        $this->record_id = $record_id;

        return $this;
    }

    public function getPhotoName(): ?string
    {
        return $this->photoName;
    }

    public function setPhotoName(string $photoName): self
    {
        $this->photoName = $photoName;

        return $this;
    }

    public function getPhotoUrlName(): ?string
    {
        return $this->photoUrlName;
    }

    public function setPhotoUrlName(string $photoUrlName): self
    {
        $this->photoUrlName = $photoUrlName;

        return $this;
    }

    public function getPhotoMediaPath(): ?string
    {
        return $this->photoMediaPath;
    }

    public function setPhotoMediaPath(string $photoMediaPath): self
    {
        $this->photoMediaPath = $photoMediaPath;

        return $this;
    }
}
