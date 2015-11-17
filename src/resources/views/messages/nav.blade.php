<div class="icon-bar vertical four-up">
    <span class="item title">Messages</span>
    <a class="item {{ Request::is('messages/compose') ? 'active' : '' }}" href="/messages/compose">
        <i class="fa fa-edit"></i>
        <label>Compose</label>
    </a>
    <a class="item {{ Request::is('messages/inbox') ? 'active' : '' }}" href="/messages/inbox">
        <i class="fa fa-inbox"></i>
        <label>Inbox</label>
    </a>
    <a class="item {{ Request::is('messages/sent') ? 'active' : '' }}" href="/messages/sent">
        <i class="fa fa-paper-plane"></i>
        <label>Sent</label>
    </a>
    @if (mustard_loaded('messaging'))
        <a class="item {{ Request::is('messages/address-book') ? 'active' : '' }}" href="/messages/address-book">
            <i class="fa fa-users"></i>
            <label>Address Book</label>
        </a>
    @endif
</div>
