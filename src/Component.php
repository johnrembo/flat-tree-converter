<?php

namespace Rembo\FlatTreeConverter;

/**
 * Component record with additional reference to {@link Configuration}
 */
class Component extends AbstractRecord
{
    private string $relation;

    public function getType(): RecordType
    {
        return RecordType::COMPONENT;
    }

    /**
     * Construct with additional relation parameter
     *
     * @param string $itemName Unique tree name
     * @param string $parent Reference to parent tree name
     * @param string $relation Reference to related configuration tree name
     */
    public function __construct(string $itemName, string $parent, string $relation)
    {
        parent::__construct($itemName, $parent);
        $this->relation = $relation;
    }

    /**
     * Get relation to configuration
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * Override default method. Do not add tree to root and attach related tree
     */
    public function populate(TreeBuilder $builder): void
    {
        $builder->add($this->getItemName());
        $builder->add($this->getParent());
        $builder->get($this->getParent())->addChild($builder->get($this->getItemName()));
        $builder->add($this->getRelation());
        $builder->get($this->getItemName())->setRelation($builder->get($this->getRelation()));
    }
}
