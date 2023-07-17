<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;
use ValueError;

class ConfirmationDialog extends ObjectBase implements SlackObjectContract
{
    use LimitsFieldLength;

    /** @var PlainText Object that defines the dialog's title */
    protected PlainText $title;

    /** @var PlainText Object that defines the explanatory text that appears in the confirm dialog */
    protected PlainText $text;

    /** @var PlainText Object to define the text of the button that confirms the action */
    protected PlainText $confirm;

    /** @var PlainText Object to define the text of the button that cancels the action */
    protected PlainText $deny;

    /** @var string|null Defines the color scheme applied to the confirm button. A value of danger will display the button with a red background on desktop, or red text on mobile. */
    protected ?string $style = null;

    /**
     * Construct a new Confirmation dialog object
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#confirm
     * @param string $title The dialog's title
     * @param string $text Explanatory text in the dialog
     * @param string $confirm Text of a button that confirms the action
     * @param string $deny Text of a button that cancels the action
     */
    public function __construct(string $title, string $text, string $confirm, string $deny)
    {
        $this->title = new PlainText($title);
        $this->text = new PlainText($text);
        $this->confirm = new PlainText($confirm);
        $this->deny = new PlainText($deny);
        $this->validateFieldLengths([
            'title' => 100,
            'text' => 300,
            'confirm' => 30,
            'deny' => 30,
        ]);
    }

    public function style(string $style): static
    {
        if ($style !== 'primary' && $style !== 'danger') {
            throw new ValueError('The style must be one of "primary" or "danger"');
        }
        $this->style = $style;

        return $this;
    }
}
