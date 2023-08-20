<?php

namespace Rembo\FlatTreeConverter;

/**
 * Indexed tree builder.
 */
class TreeBuilder
{
    private Tree $root;
    private array $index = [];

    /**
     * Construct with empty root.
     */
    public function __construct()
    {
        $this->root = new Tree();
    }

    /**
     * Get root tree with all consistent populated records.
     * Intermediate result may not contain orphans.
     *
     * @return Tree root tree
     */
    public function getRoot(): Tree
    {
        return $this->root;
    }

    /**
     * Get tree element by name using index.
     *
     * @param string $key Searched tree name
     *
     * @return Tree idexed element value or {@code NULL} when not defined
     */
    public function get(string $key): Tree
    {
        return $this->index[$key];
    }

    /**
     * Add new element to index and associate with new {@link Tree} only if element does not exist
     */
    public function add(string $itemName): void
    {
        if (!array_key_exists($itemName, $this->index)) {
            $this->index[$itemName] = new Tree($itemName);
        }
    }

    /**
     * Adapter method for {@link Record#populate} contract
     */
    public function populate(Record $record): void
    {
        $record->populate($this);
    }
}
