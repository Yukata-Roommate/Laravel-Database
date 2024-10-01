<?php

namespace YukataRm\Laravel\Database\Seeder;

use YukataRm\Laravel\Database\Seeder\InsertDataSeeder;

use Illuminate\Support\Collection;

/**
 * Multiple Data Seeder
 * 
 * @package YukataRm\Laravel\Database\Seeder
 */
abstract class MultipleDataSeeder extends InsertDataSeeder
{
    /*----------------------------------------*
     * Abstract
     *----------------------------------------*/

    /**
     * data
     * 
     * @param mixed $identifier
     * @return array<string, mixed>|\Illuminate\Support\Collection
     */
    abstract protected function data(mixed $identifier): array|Collection;

    /*----------------------------------------*
     * Required
     *----------------------------------------*/

    /**
     * execute seeding
     */
    protected function execute(): void
    {
        foreach ($this->loop() as $identifier) {
            $data = $this->data($identifier);

            $data = $this->formatData($data);

            $this->push($data);

            if ($this->data->count() < $this->chunkSize) continue;

            $this->insert();

            $this->flush();
        }
    }

    /*----------------------------------------*
     * Property
     *----------------------------------------*/

    /**
     * chunk size
     * 
     * @var int
     */
    protected int $chunkSize = 1000;

    /**
     * identifiers
     * 
     * @var array<mixed>
     */
    protected array $identifiers = [];

    /**
     * loop
     * 
     * @var int
     */
    protected int $loop = 0;

    /*----------------------------------------*
     * Method
     *----------------------------------------*/

    /**
     * identifiers
     * 
     * @return array<mixed>
     */
    protected function identifiers(): array
    {
        return $this->identifiers;
    }

    /**
     * get loop Generator
     * 
     * @return \Generator
     */
    protected function loop(): \Generator
    {
        foreach ($this->identifiers() as $identifier) {
            $this->loop++;

            yield $identifier;
        }
    }
}
