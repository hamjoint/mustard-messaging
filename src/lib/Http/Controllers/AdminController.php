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

use Hamjoint\Mustard\Http\Controllers\Controller;
use Hamjoint\Mustard\Messaging\Message;
use Hamjoint\Mustard\Messaging\Tables\AdminMessages;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Return the admin messages view.
     *
     * @return \Illuminate\View\View
     */
    public function getMessages()
    {
        $table = new AdminMessages(Message::query());

        $table->with(['recipient', 'sender']);

        if (mustard_loaded('feedback')) {
            $table->with(['recipient.feedbackReceived', 'sender.feedbackReceived']);
        }

        return view('mustard::admin.messages', [
            'table' => $table,
            'messages' => $table->paginate(),
        ]);
    }
}
