<?php

declare(strict_types=1);

namespace Rembo\FlatTreeConverter\Tests;

use PHPUnit\Framework\TestCase;

use Rembo\FlatTreeConverter\Product;
use Rembo\FlatTreeConverter\RecordType;

use function PHPUnit\Framework\assertEquals;

class ProductTest extends TestCase
{
    /**
     * Dummy getter setter tests
     *
     * @covers \Rembo\FlatTreeConverter\AbstractRecord
     * @covers \Rembo\FlatTreeConverter\Product
     * @covers \Rembo\FlatTreeConverter\Product::getType
     * @return void
     */
    public function testGettersAndSetters(): void
    {
        $record = new Product('1', '2');

        assertEquals('1', $record->getItemName());
        assertEquals('2', $record->getParent());
        assertEquals(RecordType::PRODUCT, $record->getType());
    }
}
