<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\PlainText;
use ValueError;

class Button extends InteractiveElementBase implements SlackElementContract
{
    use HasConfirmationDialog;
    use LimitsFieldLength;

    /** @var PlainText The button's text */
    protected PlainText $text;

    /** @var string|null A URL to load in the user's browser when the button is clicked */
    protected ?string $url = null;

    /** @var string|null The value to send along with the interaction payload */
    protected ?string $value = null;

    /** @var string|null Decorates buttons with alternative visual color schemes. Use this option with restraint */
    protected ?string $style = null;

    /** @var string|null A label for longer descriptive text about a button element */
    protected ?string $accessibilityLabel = null;

    /**
     * Create a new Button element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#button
     * @param string|PlainText $text
     * @param string $actionId
     */
    public function __construct(protected string $actionId, string|PlainText $text)
    {
        $this->type = 'button';
        $this->text = is_string($text) ? new PlainText($text) : $text;
        $this->validateFieldLengths([
            'text' => 75,
            'action_id' => 255,
        ]);
    }

    public function url(string $url): static
    {
        $this->url = $url;
        $this->validateFieldLengths(['url' => 3000]);

        return $this;
    }

    public function value(string $value): static
    {
        $this->value = $value;
        $this->validateFieldLengths(['value' => 2000]);

        return $this;
    }

    public function style(string $style): static
    {
        if ($style !== 'primary' && $style !== 'danger') {
            throw new ValueError('The style must be one of "primary" or "danger"');
        }
        $this->style = $style;

        return $this;
    }

    public function accessibilityLabel(string $label): static
    {
        $this->accessibilityLabel = $label;
        $this->validateFieldLengths(['accessibility_label' => 75]);

        return $this;
    }
}
