<?php

namespace Rembo\FlatTreeConverter;

/**
 * Creates {@link Record} implemetation instances
 */
class RecordFactory
{
    private const TYPE_PRODUCT = 'Изделия и компоненты';
    private const TYPE_CONFIGURATION = 'Варианты комплектации';
    private const TYPE_COMPONENT = 'Прямые компоненты';

    /**
     * Create from separate string parameters
    */
    public static function createFromParams(
        string $itemName,
        string $type,
        string $parent,
        string $relation
    ): ?Record
    {
        switch ($type) {
            case self::TYPE_PRODUCT:
                return new Product($itemName, $parent);
            case self::TYPE_CONFIGURATION:
                return new Configuration($itemName, $parent);
            case self::TYPE_COMPONENT:
                return new Component($itemName, $parent, $relation);
            default:
                return null;
        }
    }
}
