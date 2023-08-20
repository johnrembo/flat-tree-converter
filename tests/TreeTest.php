<?php

declare(strict_types=1);

namespace Rembo\FlatTreeConverter\Tests;

use PHPUnit\Framework\TestCase;
use Rembo\FlatTreeConverter\Tree;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

class TreeTest extends TestCase
{
    /**
     * Dummy getter setter tests
     *
     * @covers \Rembo\FlatTreeConverter\Tree
     * @covers \Rembo\FlatTreeConverter\Tree::setItemName
     * @covers \Rembo\FlatTreeConverter\Tree::getChildren
     * @return void
     */
    public function testGettersAndSetters(): void
    {
        $level1 = new Tree('1');
        $level2 = new Tree('2');
        $level2->setItemName('3');
        $level1->addChild($level2);

        $expected = ['3' => $level2];

        assertEquals($expected, $level1->getChildren());
    }

    /**
     * Search by name in nested levels
     * @covers \Rembo\FlatTreeConverter\Tree
     * @covers \Rembo\FlatTreeConverter\Tree::addChild
     * @covers \Rembo\FlatTreeConverter\Tree::getChild
     * @return void
     */
    public function testGetChildInSublevels(): void
    {
        $level1 = new Tree('1');
        $level2 = new Tree('2');
        $level3 = new Tree('3');
        $level1->addChild($level2);
        $level2->addChild($level3);

        assertEquals($level3, $level1->getChild('3'));
    }

    /**
     * Search by name result is {@code NULL} when not found
     *
     * @covers \Rembo\FlatTreeConverter\Tree
     * @covers \Rembo\FlatTreeConverter\Tree::addChild
     * @covers \Rembo\FlatTreeConverter\Tree::getChild
     * @return void
     */
    public function testGetChildReturnsNullWhenNotFounf(): void
    {
        $level1 = new Tree('1');
        $level2 = new Tree('2');
        $level1->addChild($level2);

        assertNull($level1->getChild('3'));
    }

    /**
     * Positive add branch tree usage test
     *
     * @covers \Rembo\FlatTreeConverter\Tree
     * @covers \Rembo\FlatTreeConverter\Tree::addChild
     * @covers \Rembo\FlatTreeConverter\Tree::getChild
     * @return void
     */
    public function testAddChild(): void
    {
        $tree = new Tree('1');
        $child = new Tree('2');
        $tree->addChild($child);

        assertEquals($child, $tree->getChild('2'));
    }

    /**
     * Test Json Formatting
     *
     * @covers \Rembo\FlatTreeConverter\Tree
     * @covers \Rembo\FlatTreeConverter\Tree::setParent
     * @covers \Rembo\FlatTreeConverter\Tree::setRelation
     * @covers \Rembo\FlatTreeConverter\Tree::toJson
     * @covers \Rembo\FlatTreeConverter\Tree::childrenToJson
     * @return void
     */
    public function testToJson(): void
    {
        $tree = new Tree('');
        $tree->setParent($tree);
        $child = new Tree('2');
        $relation = new Tree('3');
        $relatedChild = new Tree('4');
        $tree->addChild($child);
        $relation->addChild($relatedChild);
        $tree->setRelation($relation);

        $expected = '  {' . PHP_EOL .
                '    "itemName": "",' . PHP_EOL .
                '    "parent": null,' . PHP_EOL .
                '    "children": [' . PHP_EOL .
                '      {' . PHP_EOL .
                '        "itemName": "2",' . PHP_EOL .
                '        "parent": null,' . PHP_EOL .
                '        "children": []' . PHP_EOL .
                '      },' . PHP_EOL .
                '      {' . PHP_EOL .
                '        "itemName": "4",' . PHP_EOL .
                '        "parent": "3",' . PHP_EOL .
                '        "children": []' . PHP_EOL .
                '      }' . PHP_EOL .
                '    ]' . PHP_EOL .
                '  }';

        assertEquals($expected, $tree->toJson());
    }

    /**
     * Test Children Json Formatting
     *
     * @covers \Rembo\FlatTreeConverter\Tree
     * @covers \Rembo\FlatTreeConverter\Tree::setParent
     * @covers \Rembo\FlatTreeConverter\Tree::setRelation
     * @covers \Rembo\FlatTreeConverter\Tree::toJson
     * @covers \Rembo\FlatTreeConverter\Tree::childrenToJson
     * @return void
     */
    public function testChidrenToJson(): void
    {
        $tree = new Tree('1');
        $child = new Tree('2');
        $relation = new Tree('3');
        $relatedChild = new Tree('4');
        $tree->addChild($child);
        $relation->addChild($relatedChild);
        $tree->setRelation($relation);

        $expected = '[' . PHP_EOL .
                '  {' . PHP_EOL .
                '    "itemName": "2",' . PHP_EOL .
                '    "parent": "1",' . PHP_EOL .
                '    "children": []' . PHP_EOL .
                '  },' . PHP_EOL .
                '  {' . PHP_EOL .
                '    "itemName": "4",' . PHP_EOL .
                '    "parent": "1",' . PHP_EOL .
                '    "children": []' . PHP_EOL .
                '  }' . PHP_EOL .
                ']' . PHP_EOL;

        assertEquals($expected, $tree->childrenToJson());
    }
}
