<?php

namespace Rembo\FlatTreeConverter;

use Exception;

class Tree
{
    public const INDENT  = '  ';
    private string $relation;
    private string $parent;
    private string $itemName;
    private array $children = [];

    /**
     * Construct empty tree with specified name
     *
     * @param string $relation Unique tree identifier name
     */
    public function __construct(string $itemName, string $relation)
    {
        $this->itemName = $itemName;
        $this->relation = $relation;
    }

    /**
     *
     * Get tree name.
     *
     * @return string $relation given at construction
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     *
     * Get relation identifier.
     *
     * @return string $relation given at construction
     */
    public function getRelation(): string
    {
        return $this->relation;
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
        $this->parent = $tree->getRelation();
    }

    /**
     * Walk through tree and search for child with given name.
     * Does not detect cyclic references.
     *
     * @param string $relation Searched child tree name
     *
     * @return Tree first match or {@code null} when not found
     */
    public function getChild(string $relation): ?Tree
    {
        if (array_key_exists($relation, $this->children)) {
            return $this->children[$relation];
        }
        foreach ($this->children as $child) {
            $result = $child->getChild($relation);
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
        $tree->setParent($this);
        $this->children[$tree->getRelation()] = $tree;
    }

    /**
     * Get a printable JSON array of children
     *
     * @return string|false return json string or false when failed
     */
    public function childrenToJson(string $ind = self::INDENT): string|false
    {
        if (empty($this->children)) {
            $fields = '[]' . PHP_EOL;
        } else {
            $fields = '[';
            foreach ($this->children as $child) {
                $fields .= $child->toJson($ind) . ',' . PHP_EOL;
            }
            $fields = rtrim($fields, ',' . PHP_EOL) . PHP_EOL;
            $fields .= substr($ind, 0, -strlen(self::INDENT)).  ']' . PHP_EOL;
        }
        return $fields;
    }
    /**
     * Get a printable JSON string on selected fields with formatting
     *
     * @return string|false return json string or false when failed
     */
    public function toJson(string $ind = self::INDENT): string|false
    {
        $fields = $ind . '{' . PHP_EOL .
            $ind . self::INDENT . '"itemName": "' . addslashes($this->itemName) . '",' . PHP_EOL .
            $ind . self::INDENT . '"parent": ' . (empty($this->parent) ? 'null' : addslashes($this->parent)) .
                '", ' . PHP_EOL.
            $ind . self::INDENT . '"children": ' . $this->childrenToJson($ind . self::INDENT . self::INDENT) . $ind . '}';
        return $fields;
    }
}
