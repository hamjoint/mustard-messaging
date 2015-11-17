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

namespace Hamjoint\Mustard\Messaging\Http\Controllers;

use Auth;
use Hamjoint\Mustard\Http\Controllers\Controller;
use Hamjoint\Mustard\Messaging\Message;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class MessagingController extends Controller
{
    /**
     * Redirect index requests to inbox.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getIndex()
    {
        return redirect('/messages/inbox');
    }

    /**
     * Return the messages inbox view.
     *
     * @return \Illuminate\View\View
     */
    public function getInbox()
    {
        return view('mustard::messages.inbox', [
            'messages' => Auth::user()->messages()
                ->received()
                ->orderBy('sent', 'desc')
                ->paginate(),
        ]);
    }

    /**
     * Return the messages sent view.
     *
     * @return \Illuminate\View\View
     */
    public function getSent()
    {
        return view('mustard::messages.sent', [
            'messages' => Auth::user()->messages()
                ->sent()
                ->orderBy('sent', 'desc')
                ->paginate(),
        ]);
    }

    /**
     * Return the messaging address book view.
     *
     * @return \Illuminate\View\View
     */
    public function getAddressBook()
    {
        $acquaintances = Auth::user()->getAcquaintances();

        return view('mustard::messages.address-book', [
            'acquaintances' => new Paginator($acquaintances, $acquaintances->count(), config('per_page', 25)),
        ]);
    }

    /**
     * Return the messaging compose view.
     *
     * @return \Illuminate\View\View
     */
    public function getCompose()
    {
        $acquaintances = Auth::user()->getAcquaintances();

        if ($acquaintances->isEmpty()) {
            return redirect()->to('/account/contacts')->withMessage("Your contacts list is empty.");
        }

        return view('mustard::messages.compose', [
            'acquaintances' => $acquaintances->sortBy('username', SORT_NATURAL | SORT_FLAG_CASE),
            'message' => new Message,
        ]);
    }

    /**
     * Return the messaging compose reply view.
     *
     * @param integer $messageId
     * @return \Illuminate\View\View
     */
    public function getReply($messageId)
    {
        return view('mustard::messages.compose', [
            'message' => Message::findOrFail($messageId),
        ]);
    }

    /**
     * Return the messaging message view.
     *
     * @param integer $messageId
     * @return \Illuminate\View\View
     */
    public function getView($messageId)
    {
        $message = Message::find($messageId);

        $message->read = true;

        $message->save();

        return view('mustard::messages.view', [
            'message' => $message,
        ]);
    }

    /**
     * Send a message.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSend(Request $request)
    {
        $message = new Message;

        $message->subject = $request->input('subject');
        $message->body = $request->input('body');
        $message->sent = time();

        if ($request->input('parent_message_id')) {
            $parent = Message::findOrFail($request->input('parent_message_id'));

            $message->parent()->associate($parent);
        }

        $recipient = User::findOrFail($request->input('recipient_user_id'));

        if (Auth::user()->getAcquaintances()->contains($recipient)) {
            // fail
        }

        $message->recipient()->associate($recipient);

        $message->sender()->associate(Auth::user());

        $sent_copy = clone $message;

        $sent_copy->user()->associate(Auth::user());

        $message->user()->associate($recipient);

        $message->save();

        $sent_copy->save();

        return redirect()->back()->withMessage("Message sent to {$recipient->username}.");
    }

    /**
     * Manage message flags.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postManage(Request $request)
    {
        foreach ($request->input('messages') as $message_id) {
            $message = Message::find($message_id);

            if (is_null($message) || !$request->has('action')) {
                continue;
            }

            switch ($request->input('action')) {
                case 'mark_read':
                    if ($message->read == false) {
                        $message->read = true;

                        $message->save();
                    }

                    break;
                case 'mark_unread':
                    if ($message->read == true) {
                        $message->read = false;

                        $message->save();
                    }

                    break;
                case 'delete':
                    $message->delete();

                    break;
            }
        }

        return redirect()->back();
    }
}
