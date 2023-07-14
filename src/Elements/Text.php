<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasDispatchConfig;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasInitialValue;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class Text extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasDispatchConfig;
    use HasInitialValue;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var bool Whether the input will be a single line or a larger textarea */
    protected bool $multiline = false;

    /** @var int|null The minimum length of input that the user must provide */
    protected ?int $minLength = null;

    /** @var int|null The maximum length of input that the user can provide */
    protected ?int $maxLength = null;

    /**
     * Create a new Text element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#input
     * @param string $actionId The action triggered when a menu option is selected
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'plain_text_input';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function multiline(bool $multi = true): static
    {
        $this->multiline = $multi;

        return $this;
    }

    public function minLength(int $val): static
    {
        $this->minLength = $val;

        return $this;
    }

    public function maxLength(int $val): static
    {
        $this->maxLength = $val;

        return $this;
    }
}
