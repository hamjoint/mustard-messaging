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

Route::group([
    'prefix'     => env('MUSTARD_BASE', ''),
    'namespace'  => 'Hamjoint\Mustard\Messaging\Http\Controllers',
    'middleware' => ['web', 'auth'],
], function () {
    Route::get('messages', ['uses' => 'MessagingController@getIndex']);
    Route::get('messages/inbox', ['uses' => 'MessagingController@getInbox']);
    Route::get('messages/sent', ['uses' => 'MessagingController@getSent']);
    Route::get('messages/address-book', ['uses' => 'MessagingController@getAddressBook']);
    Route::get('messages/compose', ['uses' => 'MessagingController@getCompose']);
    Route::get('messages/view/{id}', ['uses' => 'MessagingController@getView']);
    Route::get('messages/reply/{id}', ['uses' => 'MessagingController@getReply']);
    Route::post('messages/send', ['uses' => 'MessagingController@postSend']);
    Route::post('messages/manage', ['uses' => 'MessagingController@postManage']);

    Route::get('admin/messages', ['uses' => 'AdminController@getMessages']);
});
