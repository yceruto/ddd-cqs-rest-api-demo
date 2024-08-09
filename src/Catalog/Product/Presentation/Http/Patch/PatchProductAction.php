<?php

namespace App\Catalog\Product\Presentation\Http\Patch;

use App\Catalog\Product\Application\Update\UpdateProduct;
use App\Catalog\Product\Presentation\View\ProductView;
use App\Shared\Presentation\OpenApi\Attribute\Id;
use OpenSolid\CqsBundle\Controller\CommandAction;
use OpenSolid\OpenApiBundle\Attribute\Payload;
use OpenSolid\OpenApiBundle\Routing\Attribute\Patch;

class PatchProductAction extends CommandAction
{
    #[Patch(
        path: '/products/{id}',
        summary: 'Update a product partially',
        tags: ['Product'],
    )]
    public function __invoke(#[Id] string $id, #[Payload] PatchProductPayload $payload): ProductView
    {
        $product = $this->commandBus()->execute(new UpdateProduct(
            $id,
            $payload->name,
            $payload->description,
            $payload->price?->amount,
            $payload->price?->currency,
            $payload->status,
        ));

        return ProductView::from($product);
    }
}
