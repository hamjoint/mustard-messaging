@extends(config('mustard.views.layout', 'mustard::layouts.master'))

@section('title')
    Sent - Messages
@stop

@section('content')
<div class="row">
    <div class="medium-3 columns">
        @include('mustard::messages.nav')
    </div>
    <div class="medium-9 columns">
        <div class="row">
            <div class="medium-12 columns">
                <form method="post" action="/messages/manage">
                    {!! csrf_field() !!}
                    <button class="button tiny radius" type="submit" name="action" value="mark_read">Mark as read</button>
                    <button class="button tiny radius" type="submit" name="action" value="mark_unread">Mark as unread</button>
                    <button class="button tiny radius alert" type="submit" name="action" value="delete">Delete</button>
                    <table class="expand">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Subject</th>
                                <th>Sent</th>
                                <th>Recipient</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($messages as $message)
                                <tr>
                                    <td><input type="checkbox" name="messages[]" value="{{ $message->getKey() }}" /></td>
                                    <td><a href="{{ $message->url }}">{{ $message->subject }}</a></td>
                                    <td>{{ mustard_time($message->getSinceSent(), 1) }} ago</td>
                                    <td>@include('mustard::user.link', ['user' => $message->recipient])</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No messages to display.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 columns pagination-centered">
                {!! $messages->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
