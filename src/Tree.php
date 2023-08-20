<?php

namespace Rembo\FlatTreeConverter;

/**
 * Base tree class. Holds one to many relation structure
 */
class Tree
{
    public const INDENT  = '  ';
    private string $itemName;
    private ?Tree $parent;
    private ?Tree $relation = null;
    private array $children = [];

    /**
     * Construct empty tree with specified name
     *
     * @param string $itemName Unique tree identifier name
     */
    public function __construct(string $itemName = '')
    {
        $this->itemName = $itemName;
    }

    /**
     *
     * Get tree name.
     *
     * @return string Tree unique name
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     *
     * Set tree name.
     *
     * @param string $itemName a new name
     *
     * @return void
     */
    public function setItemName(string $itemName): void
    {
        $this->itemName = $itemName;
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
        $this->parent = $tree;
    }

    /**
     * Walk through tree and search for child with given name.
     * Does not detect cyclic references.
     *
     * @param string $relation Searched child tree name
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
     */
    public function addChild(Tree $tree): void
    {
        $tree->setParent($this);
        $this->children[$tree->getItemName()] = $tree;
    }

    /**
     * Get all current tree children as array.
     *
     * @param string $relation Searched child tree name
     *
     * @return array of {@link Tree} objects
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * Attach related tree.
     *
     * @param Tree $tree {@link Tree} object to be related
     *
     * @return void
     */
    public function setRelation(Tree $tree): void
    {
        $this->relation = $tree;
    }

    /**
     * Get a printable JSON array of children instead of {`json_encode()`}.
     *
     * @param string $ind Indentation crutch. Not for modification
     *
     * @return string|false return json string or false when failed
     */
    public function childrenToJson(string $ind = self::INDENT): string|false
    {
        if (empty($this->children) && (($this->relation == null) || empty($this->relation->getChildren()))) {
            $fields = '[]' . PHP_EOL;
        } else {
            $fields = '[' . PHP_EOL;
            foreach ($this->children as $child) {
                $fields .= $child->toJson($ind) . ',' . PHP_EOL;
            }
            if ($this->relation != null) {
                foreach ($this->relation->getChildren() as $relatedChild) {
                    $fields .= $relatedChild->toJson($ind, $this->getItemName()) . ',' . PHP_EOL;
                }
            }
            $fields = rtrim($fields, ',' . PHP_EOL) . PHP_EOL;
            $fields .= substr($ind, 0, -strlen(self::INDENT)).  ']' . PHP_EOL;
        }
        return $fields;
    }
    /**
     * Get a formatter printable JSON string on selected fields with formatting.
     *
     * @param string $ind Indentation crutch. Not for modification
     * @param string $parentName A parent print crutch. Prints sudstituted parent name
     *
     * @return string|false return json string or false when failed
     */
    public function toJson(string $ind = self::INDENT, string $parentName = null): string|false
    {
        if (($parentName == null) && ($this->parent !== null)) {
            $parentName = $this->parent->getItemName();
        }
        $fields = $ind . '{' . PHP_EOL .
            $ind . self::INDENT . '"itemName": "' . addslashes($this->itemName) . '",' . PHP_EOL .
            $ind . self::INDENT . '"parent": ' .
                ((($this->parent == null) || ($parentName == ''))
                    ? 'null'
                    : '"' . addslashes($parentName) . '"') . ',' . PHP_EOL .
            $ind . self::INDENT . '"children": ' .
                $this->childrenToJson($ind . self::INDENT . self::INDENT) .
            $ind . '}';
        return $fields;
    }
}
