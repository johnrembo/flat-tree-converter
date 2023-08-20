<?php

namespace Rembo\FlatTreeConverter;

/**
 * Product record
 */
class Product extends AbstractRecord
{
    public function getType(): RecordType
    {
        return RecordType::PRODUCT;
    }
}
