<?php

namespace Rembo\FlatTreeConverter;

use Exception;

class Tree
{
    private string $itemName;
    private string $parent;
    private array $children = [];

    /**
     * Construct empty tree with specified name
     *
     * @param string $itemName Unique tree identifier name
     */
    public function __construct(string $itemName)
    {
        $this->itemName = $itemName;
    }

    /**
     *
     * Get tree identifier name.
     *
     * @return string $itemName given at construction
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     *
     * Set parent tree name.
     *
     * @param string $tree a parent tree object
     *
     * @return void
     */
    public function setParent(Tree $tree): void
    {
        $this->parent = $tree->getItemName();
    }

    /**
     * Walk through tree and search for child with given name.
     * Does not detect cyclic references
     *
     * @param string $itemName Searched child tree name
     *
     * @return Tree first match or {@code null} when not found
     */
    public function getChild(string $itemName): ?Tree
    {
        if (array_key_exists($itemName, $this->children)) {
            return $this->children[$itemName];
        }
        foreach ($this->children as $child) {
            $result = $child->getChild($itemName);
            if ($result !== null) {
                return $result;
            }
        }
        return null;
    }

    /**
     * Add a child tree.
     *
     * @param Tree $child A {@link Tree} object to be added
     *
     * @throws Exception when duplicate name found
     */
    public function addChild(Tree $tree): void
    {
        if ($this->getChild($tree->getItemName()) !== null) {
            throw new Exception("Duplicate tree name value");
        }
        $tree->setParent($this);
        $this->children[$tree->getItemName()] = $tree;
    }
}
