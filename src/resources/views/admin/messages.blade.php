@extends(config('mustard.views.layout', 'mustard::layouts.master'))

@section('title')
    Messages - Admin
@stop

@section('content')
    <div class="admin-messages">
        <div class="row">
            <div class="medium-3 large-2 columns">
                @include('mustard::admin.fragments.nav')
            </div>
            <div class="medium-9 large-10 columns">
                @include('tablelegs::filter')
                @if (!$table->isEmpty())
                    <table class="expand">
                        @include('tablelegs::header')
                        <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{ $message->messageId }}</td>
                                    <td>@include('mustard::user.link', ['user' => $message->recipient])</td>
                                    <td>@include('mustard::user.link', ['user' => $message->sender])</td>
                                    <td>{{ mustard_time($message->getSinceSent(), 1) }} ago</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Nothing found.</p>
                @endif
                <div class="row">
                    <div class="medium-12 columns pagination-centered">
                        {!! $table->paginator() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
