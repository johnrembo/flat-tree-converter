<?php

namespace Rembo\FlatTreeConverter;

/**
 * A flat tree record with parent reference
 */
interface Record
{
    /**
     *
     * Unique name
     *
     * @return string Item id
     */
    public function getItemName(): string;

    /**
     * Parent element name
     *
     * @return string Parent id
     */
    public function getParent(): string;

    /**
     * Element type
     *
     * @return RecordType Type of record
     */
    public function getType(): RecordType;
}
