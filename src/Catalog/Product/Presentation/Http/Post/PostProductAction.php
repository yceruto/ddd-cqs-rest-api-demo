<?php

namespace App\Catalog\Product\Presentation\Http\Post;

use App\Catalog\Product\Application\Create\CreateProduct;
use App\Catalog\Product\Domain\Model\ProductId;
use App\Catalog\Product\Presentation\View\ProductNewView;
use OpenSolid\CqsBundle\Action\CommandAction;
use OpenSolid\OpenApiBundle\Attribute\Payload;
use OpenSolid\OpenApiBundle\Routing\Attribute\Post;

class PostProductAction extends CommandAction
{
    #[Post(
        path: '/products',
        summary: 'Create a product',
        tags: ['Product'],
    )]
    public function __invoke(#[Payload] PostProductPayload $payload): ProductNewView
    {
        $product = $this->commandBus()->execute(new CreateProduct(
            $payload->id ?? ProductId::generate(),
            $payload->name,
            $payload->description,
            $payload->price->amount,
            $payload->price->currency,
            $payload->status,
        ));

        return ProductNewView::from($product);
    }
}
