<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
        operations: [
            new Get(normalizationContext: ['groups' => 'car:item']),
            new GetCollection(normalizationContext: ['groups' => 'car:list'])
        ],
    paginationEnabled: false,
)]
class Car
{
    #[Groups(['car:list', 'car:item'])]
    private ?int $id = null;

}
