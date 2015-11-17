@extends(config('mustard.views.layout', 'mustard::layouts.master'))

@section('title')
    {{ $message->subject }} - Messages
@stop

@section('content')
<div class="row">
    <div class="medium-3 columns">
        @include('mustard::messages.nav')
    </div>
    <div class="medium-9 columns">
        <table class="expand">
            <tr>
                <th width="100">Subject</th>
                <td>{{ $message->subject }}</td>
            </tr>
            <tr>
                <th width="100">Date</th>
                <td>{{ mustard_datetime($message->sent) }}</td>
            </tr>
            <tr>
                <th width="100">From</th>
                <td>@include('mustard::user.link', ['user' => $message->sender])</td>
            </tr>
            <tr>
                <th width="100">To</th>
                <td>@include('mustard::user.link', ['user' => $message->recipient])</td>
            </tr>
            <tr>
                <td colspan="2">{!! mustard_markdown($message->body) !!}</td>
            </tr>
        </table>
        <a href="/messages/{{ Auth::user() == $message->sender ? 'sent' : 'inbox' }}"><i class="fa fa-arrow-circle-left"></i> Return to {{ Auth::user() == $message->sender ? 'Sent' : 'Inbox' }}</a>
    </div>
</div>
@stop
