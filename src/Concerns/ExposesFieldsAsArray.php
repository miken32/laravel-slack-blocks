<?php

namespace NathanHeffley\LaravelSlackBlocks\Concerns;

use Illuminate\Support\Str;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;
use ReflectionClass;
use ReflectionProperty;
use ValueError;

trait ExposesFieldsAsArray
{
    /**
     * Gets an array of the object's public and protected properties
     * which can be used to construct the object's JSON for submission
     *
     * @return array<string,array|string>
     */
    public function toArray(): array
    {
        $fields = [];
        $reflector = new ReflectionClass(static::class);
        $properties = $reflector->getProperties(
            ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED
        );

        foreach ($properties as $property) {
            $name = $property->getName();
            $snake_name = Str::snake($name);
            $value = $this->{$name};
            if ($value instanceof SlackBlockContract || $value instanceof SlackObjectContract) {
                $value = $value->toArray();
            }
            $fields[$snake_name] = $value;
        }

        return array_filter($fields, fn ($v) => !is_null($v));
    }
}
