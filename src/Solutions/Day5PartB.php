<?php declare(strict_types=1);

namespace Nessworthy\AoC2020\Solutions;

use Nessworthy\AoC2020\Common\Input;
use Nessworthy\AoC2020\Common\Output;
use Nessworthy\AoC2020\LineParser\BinarySpacePartition;
use RuntimeException;

class Day5PartB implements Solution
{
    public function __construct(private BinarySpacePartition $binarySpacePartition)
    {
    }

    public function execute(Input $input, Output $output): int|string
    {
        $ids = [];
        foreach ($input->readLine() as $line) {
            $ids[$this->binarySpacePartition->getSeatIdFromInstruction($line)] = true;
        }

        foreach ($ids as $id => $unused) {
            if (isset($ids[$id+2]) && !isset($ids[$id+1])) {
                $output->writeLine((string) ($id + 1));
                return $id + 1;
            }
        }
        throw new RuntimeException('Answer not found.');
    }
}
