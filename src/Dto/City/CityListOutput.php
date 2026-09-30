<?php

namespace App\Dto\City;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use phpDocumentor\Reflection\DocBlock\Description;
use Symfony\Component\Uid\Uuid;


namespace App\Dto\City;
final class CityListOutput
{
    public function __construct(
        #[ApiProperty(description: 'Identifiant unique de la ville.')]
        public readonly Uuid $id,
        #[ApiProperty(description: 'Nom de la ville.')]
        public readonly string $name,
    ) {
    }
}
