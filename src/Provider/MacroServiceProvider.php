<?php

namespace YukataRm\Laravel\Mail\Provider;

use YukataRm\Laravel\Provider\MacroServiceProvider as BaseServiceProvider;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Support\Fluent;

/**
 * Macro Service Provider
 * 
 * @package YukataRm\Laravel\Mail\Provider
 * 
 * @method \Illuminate\Database\Schema\ColumnDefinition tinyInteger(string $column, bool $autoIncrement = false, bool $unsigned = false)
 * 
 * @method \Illuminate\Support\Fluent dropColumn(array|mixed $columns)
 * 
 * @see \Illuminate\Database\Schema\Blueprint
 */
class MacroServiceProvider extends BaseServiceProvider
{
    /**
     * macro class
     * 
     * @var string
     */
    protected string $macroClass = Blueprint::class;

    /**
     * get macros
     * 
     * @return array<string, \Closure>
     */
    protected function macros(): array
    {
        $macro = [];

        $macro["isActive"] = function (int $default = 1): ColumnDefinition {
            return $this->tinyInteger("is_active")->default($default);
        };

        $macro["dropIsActive"] = function (): Fluent {
            return $this->dropColumn("is_active");
        };

        return $macro;
    }
}
