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

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MustardMessagingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function(Blueprint $table)
        {
            $table->integer('message_id', true)->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('sender_user_id')->unsigned();
            $table->integer('recipient_user_id')->unsigned();
            $table->integer('parent_message_id')->unsigned();
            $table->integer('sent')->unsigned();
            $table->integer('read')->unsigned();
            $table->string('subject', 64);
            $table->text('body');

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('sender_user_id')->references('user_id')->on('users');
            $table->foreign('recipient_user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
