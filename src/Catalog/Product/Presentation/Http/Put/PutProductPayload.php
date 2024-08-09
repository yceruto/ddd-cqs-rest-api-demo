<?php

namespace App\Catalog\Product\Presentation\Http\Put;

use App\Catalog\Product\Domain\Model\ProductStatus;
use App\Catalog\Product\Presentation\Http\ProductPricePayload;
use OpenApi\Attributes\Schema;
use OpenSolid\OpenApiBundle\Attribute\Property;

#[Schema(writeOnly: true)]
class PutProductPayload
{
    #[Property(maxLength: 255, minLength: 3)]
    public string $name;

    #[Property(maxLength: 255, minLength: 10)]
    public string $description;

    #[Property]
    public ProductPricePayload $price;

    #[Property(enum: ProductStatus::class)]
    public string $status;
}
