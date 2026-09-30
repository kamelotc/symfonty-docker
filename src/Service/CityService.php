<?php

namespace App\Service;

use App\Repository\CityRepository;
use App\Dto\City\CityListOutput;
use App\Entity\City;

class CityService
{
    private const MAX_RESULTS = 100;
    private const DEFAULT_LIMIT = 20;

    public function __construct(
        private readonly CityRepository $cityRepository
    )
    {

    }

    public function toList(City $city): CityListOutput
    {
        return new CityListOutput($city->getId(), $city->getName());
    }

    public function search(?string $query = null, ?int $limit = null): array
    {
        if(trim($query) === ''){
            $query = null;
        }

        // Clamp $limit to [1, MAX_RESULTS]
        $limit = min(self::MAX_RESULTS, max(1, $limit ?? self::DEFAULT_LIMIT));

        return $this->cityRepository->search($query, $limit);
    }
}
