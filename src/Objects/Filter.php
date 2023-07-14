<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class Filter extends ObjectBase implements SlackObjectContract
{
    protected array $include = ['im', 'mpim', 'private', 'public'];

    /**
     * Construct a new Filter object for conversation lists
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#filter_conversations
     * @param bool $excludeIm When true, IM conversations are excluded from the results
     * @param bool $excludeMpim When true, MPIM conversations are excluded from the results
     * @param bool $excludePrivate When true, private conversations are excluded from the results
     * @param bool $excludePublic When true, public conversations are excluded from the results
     * @param bool $excludeExternalSharedChannels When true, conversations from external shared channels are excluded from the results
     * @param bool $excludeBotUsers When true, conversations from bot users are excluded from the results
     */
    public function __construct(
        bool $excludeIm = false,
        bool $excludeMpim = false,
        bool $excludePrivate = false,
        bool $excludePublic = false,
        protected bool $excludeExternalSharedChannels = false,
        protected bool $excludeBotUsers = false)
    {
        if ($excludeIm) {
            unset($this->include[0]);
        }
        if ($excludeMpim) {
            unset($this->include[1]);
        }
        if ($excludePrivate) {
            unset($this->include[2]);
        }
        if ($excludePublic) {
            unset($this->include[3]);
        }
    }
}
