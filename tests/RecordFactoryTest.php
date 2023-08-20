<?php

declare(strict_types=1);

namespace Rembo\FlatTreeConverter\Tests;

use PHPUnit\Framework\TestCase;

use Rembo\FlatTreeConverter\RecordFactory;

use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNull;

class RecordFactoryTest extends TestCase
{
    private const TYPE_PRODUCT = 'Изделия и компоненты';
    private const TYPE_CONFIGURATION = 'Варианты комплектации';
    private const TYPE_COMPONENT = 'Прямые компоненты';

    /**
     * Create all types of records from params
     *
     * @covers \Rembo\FlatTreeConverter\AbstractRecord
     * @covers \Rembo\FlatTreeConverter\Component
     * @covers \Rembo\FlatTreeConverter\RecordFactory
     * @covers \Rembo\FlatTreeConverter\RecordFactory::createFromParams
     * @return void
     */
    public function testCreateFromParams(): void
    {
        $recordFactory = new RecordFactory();

        assertInstanceOf(
            '\\Rembo\\FlatTreeConverter\\Product',
            $recordFactory->createFromParams('1', self::TYPE_PRODUCT, '', '')
        );
        assertInstanceOf(
            '\\Rembo\\FlatTreeConverter\\Configuration',
            $recordFactory->createFromParams('1', self::TYPE_CONFIGURATION, '', '')
        );
        assertInstanceOf(
            '\\Rembo\\FlatTreeConverter\\Component',
            $recordFactory->createFromParams('1', self::TYPE_COMPONENT, '', '')
        );

        assertNull($recordFactory->createFromParams('1', '', '', ''));
    }
}
