<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasDispatchConfig;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasInitialValue;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class Number extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasDispatchConfig;
    use HasInitialValue;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var string|null The minimum value */
    protected ?string $minValue = null;

    /** @var string|null The maximum value */
    protected ?string $maxValue = null;

    /**
     * Create a new Number element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#number
     * @param string $actionId The action triggered when a menu option is selected
     * @param bool $isDecimalAllowed Whether decimals will be accepted
     */
    public function __construct(protected string $actionId, protected bool $isDecimalAllowed)
    {
        $this->type = 'number_input';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function initialValue(int|float|string $val): static
    {
        $this->initialValue = (string)$val;

        return $this;
    }

    public function minValue(int|float|string $val): static
    {
        $this->minValue = (string)$val;

        return $this;
    }

    public function maxValue(int|float|string $val): static
    {
        $this->maxValue = (string)$val;

        return $this;
    }
}
