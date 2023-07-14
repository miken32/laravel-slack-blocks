<?php

namespace NathanHeffley\LaravelSlackBlocks\Concerns;

use Illuminate\Support\Str;
use NathanHeffley\LaravelSlackBlocks\Objects\TextBase;
use ValueError;

trait LimitsFieldLength
{
    /**
     * Checks the length of the field's value, throwing an exception in case it's too long
     *
     * @param array<string,int> $lengths The field lengths, indexed by name
     * @param bool $trim If true, just truncate long values instead of throwing an exception
     * @return void
     */
    private function validateFieldLengths(array $lengths, bool $trim = false): void
    {
        foreach ($lengths as $field => $limit) {
            $camel = Str::camel($field);
            $text = str_replace('_', ' ', $field);
            $value = $this->{$camel};
            $length = is_array($value) ? count($value) : strlen($value);
            if ($length > $limit) {
                if ($trim && is_string($value)) {
                    $this->{$camel} = substr($value, 0, $limit);
                } elseif ($trim && $value instanceof TextBase) {
                    $value->trim($limit);
                } else {
                    throw new ValueError("The $text must not be more than $limit characters");
                }
            }
        }
    }
}
