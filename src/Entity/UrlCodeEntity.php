<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'url_codes')]
class UrlCodeEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    public function __construct(
    #[ORM\Column(length: 255)]
    private string $url,
    #[ORM\Column(length: 255)]
    private string $code )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

}
