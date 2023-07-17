<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class OptionGroup extends ObjectBase implements SlackObjectContract
{
    use LimitsFieldLength;

    /** @var PlainText The text object shown above this group of options */
    protected PlainText $label;

    /**
     * Construct a new Option Group object
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#option_group
     * @param string|PlainText $label The content of the text Plain Text object
     * @param array<Option> $options
     */
    public function __construct(string|PlainText $label, protected array $options)
    {
        $this->label = is_string($label) ? new PlainText($label) : $label;
        $this->validateFieldLengths(['label' => 75]);
        $this->options = array_filter(
            $this->options,
            fn ($v) => $v instanceof Option
        );
    }
}
