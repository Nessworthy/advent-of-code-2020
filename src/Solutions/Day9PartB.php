<?php declare(strict_types=1);

namespace Nessworthy\AoC2020\Solutions;

use Nessworthy\AoC2020\Common\Input;
use Nessworthy\AoC2020\Common\Output;
use RuntimeException;

class Day9PartB implements Solution
{
    /**
     * @var Day9PartA
     */
    private Day9PartA $day9PartA;

    public function __construct(Day9PartA $day9PartA)
    {
        $this->day9PartA = $day9PartA;
    }

    public function execute(Input $input, Output $output): int|string
    {
        $target = $this->day9PartA->execute($input, $output);

        $output->writeLine(sprintf('Target: %d', $target));

        $input->reset();

        $bucket = [];

        foreach ($input->readLine() as $line) {
            $number = (int) $line;
            $bucket[] = $number;
            $total = array_sum($bucket);

            if ($total > $target) {
                while ($total > $target) {
                    $output->writeLine('[' . implode(', ', $bucket) . '] (Too High)');
                    array_shift($bucket);
                    $total = array_sum($bucket);
                }
            }

            if ($total === $target) {
                $bucket[] = $number;
                $output->writeLine('[' . implode(', ', $bucket) . '] = ' . $target);
                $output->writeLine(sprintf('%d + %d = %d', min($bucket), max($bucket), min($bucket) + max($bucket)));
                return min($bucket) + max($bucket);
            }

            $output->writeLine('[' . implode(', ', $bucket) . '] (Too Low)');
        }

        throw new RuntimeException('Answer not found.');
    }
}
