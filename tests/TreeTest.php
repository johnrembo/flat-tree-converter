<?php

namespace Rembo\FlatTreeConverter\Tests;

use PHPUnit\Framework\TestCase;
use Rembo\FlatTreeConverter\Tree;

use function PHPUnit\Framework\assertEquals;

class TreeTest extends TestCase
{
    /**
     * Positive add branch tree usage test
     *
     * @return void
     */
    public function testAddBranch(): void
    {
        $tree = new Tree('1', 'level 1');
        $subTree = new Tree('2', 'level 2');
        $tree->addBranch($subTree);

        $expeced = (object) [
            "itemName" => '1',
            "parent" => null,
            "children" => [
                (object) [
                    "itemName" => '2',
                    "parent" => "1",
                    "children" => []
                ]
            ]
        ];

        assertEquals($expeced, $tree);
    }
}
