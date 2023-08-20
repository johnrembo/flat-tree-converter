<?php

namespace Rembo\FlatTreeConverter;

/**
 * Default implemetation with {@link TreePopulator}.
 * Populator adds a new tree object into {@link TreeBuilder}
 * tree structure. When parent does not exist creates and adds empty {@link Tree}
 * into index. When parent is not specified adds new child in root tree.
 */
abstract class AbstractRecord implements Record, TreePopulator
{
    private string $itemName;
    private string $parent;

    /**
     * Construct from string parameters
     *
     * @param string $itemName Unique tree name
     * @param string $parent Reference to parent tree unique name
     */
    public function __construct(string $itemName, $parent)
    {
        $this->itemName = $itemName;
        $this->parent = $parent;
    }

    public function getItemName(): string
    {
        return $this->itemName;
    }

    public function getParent(): string
    {
        return $this->parent;
    }

    public function populate(TreeBuilder $builder): void
    {
        $builder->add($this->getItemName());
        if (empty($this->getParent())) {
            $builder->getRoot()->addChild($builder->get($this->getItemName()));
        } else {
            $builder->add($this->getParent());
            $builder->get($this->getParent())->addChild($builder->get($this->getItemName()));
        }
    }

    abstract public function getType(): RecordType;
}
