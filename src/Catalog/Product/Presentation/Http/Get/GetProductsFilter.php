<?php

namespace App\Catalog\Product\Presentation\Http\Get;

use OpenSolid\OpenApiBundle\Attribute\Param;
use Symfony\Component\Validator\Constraints as Assert;

class GetProductsFilter
{
    #[Param]
    #[Assert\Length(min: 3, max: 255)]
    public ?string $name = null;
}
