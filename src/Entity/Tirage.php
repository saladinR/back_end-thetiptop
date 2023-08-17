<?php

namespace App\Entity;

use App\Repository\TirageRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Operation;
use App\Controller\TirageController;
use ApiPlatform\Metadata\ApiResource;



#[ApiResource(operations: [
    new post(name: 'valide', uriTemplate: '/tirage/valide', controller: TirageController::class),
])]
#[ORM\Entity(repositoryClass: TirageRepository::class)]
class Tirage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $numero = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }
}
