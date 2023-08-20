<?php

namespace Rembo\FlatTreeConverter;

/**
 * Product configuration record
 */
class Configuration extends AbstractRecord
{
    public function getType(): RecordType
    {
        return RecordType::CONFIGURATION;
    }
}
