<?php

declare(strict_types=1);

namespace Rembo\FlatTreeConverter\Tests;

use PHPUnit\Framework\TestCase;

use Rembo\FlatTreeConverter\Configuration;
use Rembo\FlatTreeConverter\RecordType;

use function PHPUnit\Framework\assertEquals;

class ConfigurationTest extends TestCase
{
    /**
     * Dummy getter setter tests
     *
     * @covers \Rembo\FlatTreeConverter\AbstractRecord
     * @covers \Rembo\FlatTreeConverter\Configuration
     * @covers \Rembo\FlatTreeConverter\Configuration::getType
     * @return void
     */
    public function testGettersAndSetters(): void
    {
        $record = new Configuration('1', '2');

        assertEquals('1', $record->getItemName());
        assertEquals('2', $record->getParent());
        assertEquals(RecordType::CONFIGURATION, $record->getType());
    }
}
