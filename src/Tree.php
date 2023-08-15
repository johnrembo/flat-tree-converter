<?php

namespace Rembo\FlatTreeConverter;

class Tree
{
    private $branches = [];

    /**
     * Add a child tree
     *
     * @param $branch A {@link Tree} object to be added
     */
    public function addBranch(Tree $tree): void
    {
        $branches[] = $tree;
    }
}
