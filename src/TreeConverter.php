<?php

namespace Rembo\FlatTreeConverter;

use Symfony\Component\Console\Output\OutputInterface;

class TreeConverter
{
    /**
     * Construct from input file name
     */

    public function __construct(string $inputFileName, OutputInterface $output)
    {
        $output->writeln("Input filename: {$inputFileName}");
    }
}
