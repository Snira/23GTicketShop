<?php

declare(strict_types=1);

namespace App\Enums;

abstract class EloquentAttributeDataType
{
    public const REAL = 'real';
    public const FLOAT = 'float';
    public const DOUBLE = 'double';
    public const INTEGER = 'integer';
    public const STRING = 'string';
    public const BOOLEAN = 'boolean';
    public const DATE = 'date';
    public const DATE_TIME = 'datetime';
    public const TIMESTAMP = 'timestamp';
    public const OBJECT = 'object';
    public const ARRAY = 'array';
    public const COLLECTION = 'collection';
}
