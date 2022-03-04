<div class="member-login member_afterlogin">
    <div class="member-title">
        Welcome </br>
        @if(Session::has('LoggedMember'))
        {{Session::get('LoggedMember')['name']}}
        @endif
    </div>

    <div class="member_aftelogin_btn">
        <ul>
            <li>
                <a href="{{ route('member.dashboard')}}">Member Dashboard</a>
            </li>
            <li>
                <a href="#">Invoices & Payment</a>
            </li>
            <li class="mem-aftlogin_signout">
                <a href="{{ route('member.logout') }}">Sign out</a>
            </li>
        </ul>
    </div>

</div>