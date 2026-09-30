<?php

namespace App\Entity;

use App\Dto\City\CityListOutput;
use App\Repository\CityRepository;
use App\State\City\CityCollectionProvider;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Impl\AbstractEntity;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\QueryParameter;
#[ApiResource(
    operations: [
        // /api/cities
        new GetCollection(
            provider: CityCollectionProvider::class,
            output: CityCollectionProvider::class,
            paginationEnabled: false,
            parameters: [
                'q' => new QueryParameter(
                    description: 'Filtre textuel sur la recherche de la ville',
                    schema: ['type' => 'string']
                ),
                'limit' => new QueryParameter(
                    description: 'Limite sur le nombre de villes retournées',
                    schema: [
                        'type' => 'integer',
                        'minimum' => 1,
                        'maximum' => 100,
                        'default' => 20,
                    ]
                )
            ]
        ),
    ]
)]


#[ORM\Entity(repositoryClass: CityRepository::class)]
class City extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private \Symfony\Component\Uid\Uuid $id;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->id = \Symfony\Component\Uid\Uuid::v7();
    }

    public function getId(): \Symfony\Component\Uid\Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
