<?php

namespace YukataRm\Laravel\Database\Seeder;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

/**
 * Base Seeder
 * 
 * @package YukataRm\Laravel\Database\Seeder
 */
abstract class BaseSeeder extends Seeder
{
    /*----------------------------------------*
     * Abstract
     *----------------------------------------*/

    /**
     * execute seeding
     * 
     * @return void
     */
    abstract protected function execute(): void;

    /*----------------------------------------*
     * Required
     *----------------------------------------*/

    /**
     * run
     * 
     * @param array<mixed> $parameters
     */
    public function run(...$parameters): void
    {
        $this->setParameters($parameters);

        $this->prepare();

        $this->execute();

        $this->passed();
    }

    /**
     * prepare seeding
     * 
     * @return void
     */
    protected function prepare(): void {}

    /**
     * passed seeding
     * 
     * @return void
     */
    protected function passed(): void {}

    /*----------------------------------------*
     * Parameter
     *----------------------------------------*/

    /**
     * parameters
     * 
     * @var array<int|string, mixed>
     */
    protected array $parameters;

    /**
     * set parameters
     * 
     * @param array<mixed> $parameters
     * @return void
     */
    protected function setParameters(array $parameters = []): void
    {
        $this->parameters = $parameters;
    }

    /**
     * get parameter
     * 
     * @param int|string|null $key
     * @return mixed
     */
    protected function parameters(int|string|null $index = null): mixed
    {
        if (is_null($index)) return $this->parameters;

        if (isset($this->parameters[$index])) return $this->parameters[$index];

        return null;
    }

    /**
     * get parameter
     * 
     * @param string $name 
     */
    public function __get(string $name): mixed
    {
        return $this->parameters($name);
    }

    /*----------------------------------------*
     * Method
     *----------------------------------------*/

    /**
     * hash text
     * 
     * @param string $text
     * @return string
     */
    protected function hash(string $text): string
    {
        return Hash::make($text);
    }
}
