<?php

namespace App\Entity;

use App\Repository\RecordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecordRepository::class)]
class Record
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $unique_key = null;

    #[ORM\Column]
    private ?bool $is_draft = null;

    #[ORM\Column]
    private ?bool $is_moderated = null;

    #[ORM\OneToMany(mappedBy: 'record_id', targetEntity: RecordText::class)]
    private Collection $recordTexts;

    #[ORM\OneToMany(mappedBy: 'record_id', targetEntity: RecordPhotos::class)]
    private Collection $recordPhotos;

    public function __construct()
    {
        $this->recordTexts = new ArrayCollection();
        $this->recordPhotos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUniqueKey(): ?string
    {
        return $this->unique_key;
    }

    public function setUniqueKey(string $unique_key): self
    {
        $this->unique_key = $unique_key;

        return $this;
    }

    public function isIsDraft(): ?bool
    {
        return $this->is_draft;
    }

    public function setIsDraft(bool $is_draft): self
    {
        $this->is_draft = $is_draft;

        return $this;
    }

    public function isIsModerated(): ?bool
    {
        return $this->is_moderated;
    }

    public function setIsModerated(bool $is_moderated): self
    {
        $this->is_moderated = $is_moderated;

        return $this;
    }

    /**
     * @return Collection<int, RecordText>
     */
    public function getRecordTexts(): Collection
    {
        return $this->recordTexts;
    }

    public function addRecordText(RecordText $recordText): self
    {
        if (!$this->recordTexts->contains($recordText)) {
            $this->recordTexts->add($recordText);
            $recordText->setRecordId($this);
        }

        return $this;
    }

    public function removeRecordText(RecordText $recordText): self
    {
        if ($this->recordTexts->removeElement($recordText)) {
            // set the owning side to null (unless already changed)
            if ($recordText->getRecordId() === $this) {
                $recordText->setRecordId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecordPhotos>
     */
    public function getRecordPhotos(): Collection
    {
        return $this->recordPhotos;
    }

    public function addRecordPhoto(RecordPhotos $recordPhoto): self
    {
        if (!$this->recordPhotos->contains($recordPhoto)) {
            $this->recordPhotos->add($recordPhoto);
            $recordPhoto->setRecordId($this);
        }

        return $this;
    }

    public function removeRecordPhoto(RecordPhotos $recordPhoto): self
    {
        if ($this->recordPhotos->removeElement($recordPhoto)) {
            // set the owning side to null (unless already changed)
            if ($recordPhoto->getRecordId() === $this) {
                $recordPhoto->setRecordId(null);
            }
        }

        return $this;
    }

}
