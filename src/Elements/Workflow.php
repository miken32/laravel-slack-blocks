<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\PlainText;
use ValueError;

class Workflow extends InteractiveElementBase implements SlackElementContract
{
    use LimitsFieldLength;

    /** @var PlainText The button's text */
    protected PlainText $text;

    /** @var string Decorates buttons with alternative visual color schemes. Use this option with restraint */
    protected string $style = 'default';

    /** @var string A label for longer descriptive text about a button element */
    protected string $accessibilityLabel = '';

    /**
     * Create a new Workflow button element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#workflow_button
     * @param string|PlainText $text
     * @param Workflow $workflow
     */
    public function __construct(string|PlainText $text, protected Workflow $workflow)
    {
        $this->type = 'workflow_button';
        // no action ID on this element type
        $this->actionId = null;
        $this->text = is_string($text) ? new PlainText($text) : $text;
        $this->validateFieldLengths(['text' => 75]);
    }

    public function style(string $style): static
    {
        if (!in_array($style, ['default', 'primary', 'danger'])) {
            throw new ValueError('The style must be one of "default", "primary", or "danger"');
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
