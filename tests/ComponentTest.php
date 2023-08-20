<?php

declare(strict_types=1);

namespace Rembo\FlatTreeConverter\Tests;

use PHPUnit\Framework\TestCase;

use Rembo\FlatTreeConverter\Component;
use Rembo\FlatTreeConverter\RecordType;

use function PHPUnit\Framework\assertEquals;

class ComponentTest extends TestCase
{
    /**
     * Dummy getter setter tests
     *
     * @covers \Rembo\FlatTreeConverter\AbstractRecord
     * @covers \Rembo\FlatTreeConverter\Component
     * @covers \Rembo\FlatTreeConverter\Component::getType
     * @return void
     */
    public function testGettersAndSetters(): void
    {
        $record = new Component('1', '2', '3');

        assertEquals('1', $record->getItemName());
        assertEquals('2', $record->getParent());
        assertEquals(RecordType::COMPONENT, $record->getType());
    }
}
