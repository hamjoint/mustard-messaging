<?php

/*

This file is part of Mustard.

Mustard is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Mustard is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Mustard.  If not, see <http://www.gnu.org/licenses/>.

*/

namespace Hamjoint\Mustard\Messaging;

use Hamjoint\Mustard\NonSequentialIdModel;

class Message extends NonSequentialIdModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The database key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'message_id';

    /**
     * Return the time difference between now and the date the message was sent.
     *
     * @return \DateInterval
     */
    public function getSinceSent()
    {
        $sent = \DateTime::createFromFormat('U', $this->sent);

        return $sent->diff(new \DateTime());
    }

    /**
     * Override the parent's url attribute
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return '/messages/view/' . $this->getKey();
    }

    /**
     * Scope of sent messages.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSent($query)
    {
        return $query->whereRaw('sender_user_id = user_id');
    }

    /**
     * Scope of received messages.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReceived($query)
    {
        return $query->whereRaw('recipient_user_id = user_id');
    }

    /**
     * Scope of unread messages.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    /**
     * Scope of read messages.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRead($query)
    {
        return $query->where('read', true);
    }

    /**
     * Relationship to the receiving user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo('\Hamjoint\Mustard\User', 'recipient_user_id');
    }

    /**
     * Relationship to the sending user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('\Hamjoint\Mustard\User', 'sender_user_id');
    }

    /**
     * Relationship to a user's account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\Hamjoint\Mustard\User');
    }
}
