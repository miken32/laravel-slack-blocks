<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;
use ValueError;

class Filter extends ObjectBase implements SlackObjectContract
{
    /** @var array<string> Indicates which type of conversations should be included in the list */
    protected array $include = [];

    /** @var bool When true, IM conversations are included in the results */
    private bool $im = false;

    /** @var bool When true, multi-person IM conversations are included in the results */
    private bool $mpim = false;

    /** @var bool When true, private conversations are included in the results */
    private bool $private = false;

    /** @var bool When true, public conversations are included in the results */
    private bool $public = false;

    /** @var bool When true, conversations from external shared channels are excluded from the results */
    protected bool $excludeExternalSharedChannels = false;

    /** @var bool When true, conversations from bot users are excluded from the results */
    protected bool $excludeBotUsers = false;

    /**
     * Construct a new Filter object for conversation lists
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#filter_conversations
     * @param array $include Which type of conversations should be included in the list
     */
    public function __construct(array $include = ['im', 'mpim', 'public', 'private'])
    {
        if ($include === []) {
            throw new ValueError('The include field cannot be an empty array');
        }
        if (in_array('im', $include)) {
            $this->im = true;
        }
        if (in_array('mpim', $include)) {
            $this->mpim = true;
        }
        if (in_array('public', $include)) {
            $this->public = true;
        }
        if (in_array('private', $include)) {
            $this->private = true;
        }
    }

    public function excludeExternalSharedChannels(bool $exclude = true): static
    {
        $this->excludeExternalSharedChannels = $exclude;

        return $this;
    }

    public function excludeBotUsers(bool $exclude = true): static
    {
        $this->excludeBotUsers = $exclude;

        return $this;
    }

    public function toArray(): array
    {
        if ($this->im && !in_array('im', $this->include)) {
            $this->include[] = 'im';
        }
        if ($this->mpim && !in_array('mpim', $this->include)) {
            $this->include[] = 'mpim';
        }
        if ($this->public && !in_array('public', $this->include)) {
            $this->include[] = 'public';
        }
        if ($this->private && !in_array('private', $this->include)) {
            $this->include[] = 'private';
        }

        return parent::toArray();
    }
}
