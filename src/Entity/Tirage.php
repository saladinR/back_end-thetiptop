<?php

namespace App\Entity;

use App\Repository\TirageRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Operation;
use App\Controller\TirageController;
use App\Controller\HistoryController;
use ApiPlatform\Metadata\ApiResource;



#[ApiResource(operations: [
    new post(name: 'valide', uriTemplate: '/tirage/valide', controller: TirageController::class),
    new post(name: 'history', uriTemplate: '/tirage/history', controller: HistoryController::class),
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

    #[ORM\Column]
    private ?int $id_user = null;

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

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }
}
