<?php

declare(strict_types=1);

namespace Rembo\FlatTreeConverter\Tests;

use PHPUnit\Framework\TestCase;
use Rembo\FlatTreeConverter\AbstractRecord;

use Rembo\FlatTreeConverter\RecordType;

use Rembo\FlatTreeConverter\TreeBuilder;

use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertEquals;

class ConcreteRecord extends AbstractRecord
{
    public function getType(): RecordType
    {
        return RecordType::PRODUCT;
    }
}

class AbstractRecordTest extends TestCase
{
    /**
     * Dummy getter setter tests
     *
     * @covers \Rembo\FlatTreeConverter\AbstractRecord
     * @covers \Rembo\FlatTreeConverter\AbstractRecord::getItemName
     * @covers \Rembo\FlatTreeConverter\AbstractRecord::getParent
     * @return void
     */
    public function testGettersAndSetters(): void
    {
        $record = new ConcreteRecord('1', '2');

        assertEquals('1', $record->getItemName());
        assertEquals('2', $record->getParent());
    }

    /**
     * Positive popultate adds element to root tree and index
     *
     * @covers \Rembo\FlatTreeConverter\Tree
     * @covers \Rembo\FlatTreeConverter\TreeBuilder
     * @covers \Rembo\FlatTreeConverter\AbstractRecord
     * @covers \Rembo\FlatTreeConverter\AbstractRecord::populate
     * @return void
     */
    public function testPopulate(): void
    {
        $builder = new TreeBuilder();
        $record1 = new ConcreteRecord('1', '');
        $record2 = new ConcreteRecord('2', '1');
        $record1->populate($builder);
        $record2->populate($builder);

        assertEquals('1', $builder->get('1')->getItemName());
        assertEquals('2', $builder->get('2')->getItemName());
        assertEquals('1', $builder->getRoot()->getChild('1')->getItemName());
        assertArrayHasKey('2', $builder->getRoot()->getChild('1')->getChildren());
    }
}
