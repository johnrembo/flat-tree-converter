<?php

namespace Rembo\FlatTreeConverter;

/**
 * A flat tree record with parent reference
 */
interface Record
{
    /**
     * @return string Item id name
     */
    public function getItemName(): string;

    /**
     * @return string Parent id
     */
    public function getParent(): string;

    /**
     * @return RecordType Type of record
     */
    public function getType(): RecordType;

    /**
     * Populate a new tree into {@link TreeBuilder}
     */
    public function populate(TreeBuilder $builder): void;
}
