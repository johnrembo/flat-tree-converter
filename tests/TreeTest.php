<?php

declare(strict_types=1);

namespace Rembo\FlatTreeConverter\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Rembo\FlatTreeConverter\Tree;

use function PHPUnit\Framework\assertEquals;

class TreeTest extends TestCase
{
    /**
     * Positive search in nested levels
     *
     * @covers \Rembo\FlatTreeConverter\Tree
     * @return void
     */
    public function testSearchSublevels(): void
    {
        $level1 = new Tree('1');
        $level2 = new Tree('2');
        $level3 = new Tree('3');
        $level1->addChild($level2);
        $level2->addChild($level3);

        assertEquals($level3, $level1->getChild('3'));
    }

    /**
     * Positive add branch tree usage test
     *
     * @covers \Rembo\FlatTreeConverter\Tree
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
     * Negative duplicate branch add test
     *
     * @covers \Rembo\FlatTreeConverter\Tree
     * @return void
     */
    public function testAddChildThrowsExceptionOnDuplicateValue(): void
    {
        $tree = new Tree('1');
        $child = new Tree('2');
        $tree->addChild($child);

        $this->expectException(Exception::class);
        $tree->addChild($child);
    }
}
