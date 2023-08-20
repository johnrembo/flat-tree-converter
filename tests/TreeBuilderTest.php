<?php

declare(strict_types=1);

namespace Rembo\FlatTreeConverter\Tests;

use PHPUnit\Framework\TestCase;

use Rembo\FlatTreeConverter\Component;
use Rembo\FlatTreeConverter\Configuration;
use Rembo\FlatTreeConverter\Product;

use Rembo\FlatTreeConverter\TreeBuilder;

use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertEquals;

class TreeBuilderTest extends TestCase
{
    /**
     * Positive popultate adds element to root tree and index
     *
     * @covers \Rembo\FlatTreeConverter\Tree
     * @covers \Rembo\FlatTreeConverter\TreeBuilder
     * @covers \Rembo\FlatTreeConverter\AbstractRecord
     * @covers \Rembo\FlatTreeConverter\AbstractRecord::populate
     * @covers \Rembo\FlatTreeConverter\Component
     * @covers \Rembo\FlatTreeConverter\Component::populate
     *
     * @return void
     */
    public function testPopulate(): void
    {
        $builder = new TreeBuilder();
        $product = new Product('1', '');
        $configuration = new Configuration('2', '1');
        $component = new Component('3', '1', '2');
        $builder->populate($product);
        $builder->populate($configuration);
        $builder->populate($component);

        assertEquals('1', $builder->get('1')->getItemName());
        assertEquals('2', $builder->get('2')->getItemName());
        assertEquals('1', $builder->getRoot()->getChild('1')->getItemName());
        assertArrayHasKey('2', $builder->getRoot()->getChild('1')->getChildren());
        assertArrayHasKey('3', $builder->getRoot()->getChild('1')->getChildren());
    }
}
