<?php

namespace App\Catalog\Product\Domain\Model;

use Symfony\Component\Translation\TranslatableMessage;

enum ProductStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    /**
     * @return TranslatableMessage[]
     */
    public static function translatableValues(): array
    {
        return [
            self::DRAFT->value => new TranslatableMessage('catalog.product.status.draft'),
            self::PUBLISHED->value => new TranslatableMessage('catalog.product.status.published'),
            self::ARCHIVED->value => new TranslatableMessage('catalog.product.status.archived'),
        ];
    }

    public function label(): TranslatableMessage
    {
        return self::translatableValues()[$this->value];
    }

    public function isDraft(): bool
    {
        return self::DRAFT === $this;
    }

    public function isPublished(): bool
    {
        return self::PUBLISHED === $this;
    }

    public function isArchived(): bool
    {
        return self::ARCHIVED === $this;
    }
}
