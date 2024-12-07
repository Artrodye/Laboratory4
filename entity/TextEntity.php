<?php

namespace app\entity;

use app\Repository\TextEntityRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: TextEntityRepository::class)]
#[Table('crypttext')]
class TextEntity
{
    #[Id]
    #[Column(name: 'id'), GeneratedValue]
    private int $id;

    #[Column(name: 'text')]
    private string $text;

    #[Column(name: 'openKey')]
    private int $openKey;

    #[Column(name: 'b')]
    private int $b;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): TextEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): TextEntity
    {
        $this->text = $text;
        return $this;
    }

    public function getOpenKey(): int
    {
        return $this->openKey;
    }

    public function setOpenKey(int $openKey): TextEntity
    {
        $this->openKey = $openKey;
        return $this;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function setB(int $b): TextEntity
    {
        $this->b = $b;
        return $this;
    }
}