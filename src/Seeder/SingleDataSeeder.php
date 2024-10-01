<?php

namespace YukataRm\Laravel\Database\Seeder;

use YukataRm\Laravel\Database\Seeder\InsertDataSeeder;

use Illuminate\Support\Collection;

/**
 * Single Data Seeder
 * 
 * @package YukataRm\Laravel\Database\Seeder
 */
abstract class SingleDataSeeder extends InsertDataSeeder
{
    /*----------------------------------------*
     * Abstract
     *----------------------------------------*/

    /**
     * data
     * 
     * @return array<string, mixed>|\Illuminate\Support\Collection
     */
    abstract protected function data(): array|Collection;

    /*----------------------------------------*
     * Required
     *----------------------------------------*/

    /**
     * execute seeding
     */
    protected function execute(): void
    {
        $data = $this->data();

        $data = $this->formatData($data);

        $this->set($data);
    }
}
