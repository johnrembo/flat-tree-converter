<?php

namespace Rembo\FlatTreeConverter;

/**
 * A flat tree record with parent reference
 */
interface TreePopulator
{
    /**
     * Populate a new tree into {@link TreeBuilder}
     *
     * @param TreeBuilder $builder A tree builder to be populated
     */
    public function populate(TreeBuilder $builder): void;
}
