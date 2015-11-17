@extends(config('mustard.views.layout', 'mustard::layouts.master'))

@section('title')
    Compose - Messages
@stop

@section('content')
<div class="row">
    <div class="medium-3 columns">
        @include('mustard::messages.nav')
    </div>
    <div class="medium-9 columns">
        <form method="post" action="/messages/send" data-abide="true">
            {!! csrf_field() !!}
            <fieldset>
                <div class="row">
                    <div class="medium-12 columns">
                        <label>Recipient
                            <select name="recipient">
                                @foreach ($acquaintances as $acquaintance)
                                    <option value="{{ $acquaintance->userId }}">{{ $acquaintance->username }}</option>
                                @endforeach
                            </select>
                        </label>
                        <small class="error">Please enter a subject line.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 columns">
                        <label>Subject
                            <input type="text" name="subject" placeholder="What's your message about?" required />
                        </label>
                        <small class="error">Please enter a subject line.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 columns">
                        <label>Message
                            <textarea name="body" placeholder="Your message" required></textarea>
                        </label>
                        <small class="error">Please enter a message.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 columns text-right">
                        <button class="button radius"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@stop
