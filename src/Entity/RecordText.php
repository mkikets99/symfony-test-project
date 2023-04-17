<?php

namespace App\Entity;

use App\Repository\RecordTextRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecordTextRepository::class)]
class RecordText
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recordTexts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Record $record_id = null;

    #[ORM\Column(length: 3)]
    private ?string $lang_code = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $bodyHTML = null;

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

    public function getLangCode(): ?string
    {
        return $this->lang_code;
    }

    public function setLangCode(string $lang_code): self
    {
        $this->lang_code = $lang_code;

        return $this;
    }

    public function getBodyHTML(): ?string
    {
        return $this->bodyHTML;
    }

    public function setBodyHTML(string $bodyHTML): self
    {
        $this->bodyHTML = $bodyHTML;

        return $this;
    }
}
