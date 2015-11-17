@extends(config('mustard.views.layout', 'mustard::layouts.master'))

@section('title')
    Address book - Messages
@stop

@section('content')
<div class="row">
    <div class="medium-3 large-2 columns">
        @include('mustard::messages.nav')
    </div>
    <div class="medium-9 large-10 columns">
        <div class="row">
            <div class="medium-12 columns">
                <dl class="sub-nav">
                    <dt>Filter:</dt>
                    <dd class="active"><a href="#">All</a></dd>
                    <dd><a href="#">Active</a></dd>
                    <dd><a href="#">Pending</a></dd>
                    <dd class="hide-for-small-only"><a href="#">Suspended</a></dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 columns">
                <table class="expand">
                    <thead>
                        <tr>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($acquaintances as $acquaintance)
                            <tr>
                                <td>@include('mustard::user.link', ['user' => $acquaintance])</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">You haven't got any contacts.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 columns pagination-centered">
                {!! $acquaintances->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
