<?php

namespace App\Catalog\Product\Presentation\Http\Put;

use App\Catalog\Product\Application\Update\UpdateProduct;
use App\Catalog\Product\Presentation\View\ProductView;
use App\Shared\Presentation\OpenApi\Attribute\Id;
use OpenSolid\CqsBundle\Action\CommandAction;
use OpenSolid\OpenApiBundle\Attribute\Payload;
use OpenSolid\OpenApiBundle\Routing\Attribute\Put;

class PutProductAction extends CommandAction
{
    #[Put(
        path: '/products/{id}',
        summary: 'Update a product',
        tags: ['Product'],
    )]
    public function __invoke(#[Id] string $id, #[Payload] PutProductPayload $payload): ProductView
    {
        $product = $this->commandBus()->execute(new UpdateProduct(
            $id,
            $payload->name,
            $payload->description,
            $payload->price->amount,
            $payload->price->currency,
            $payload->status,
        ));

        return ProductView::from($product);
    }
}
