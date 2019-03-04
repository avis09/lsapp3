<!-- Sidebar menu-->

{{--USER (student or staff)------------------------------------------------------------}}
@if (Auth::check() && Auth::user()->userRoleID == 1)
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        {{--<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">--}}
        {{--<div>--}}
        {{--<p class="app-sidebar__user-name">John Doe</p>--}}
        {{--<p class="app-sidebar__user-designation">Frontend Developer</p>--}}
        {{--</div>--}}
        {{--</div>--}}
        <ul class="app-menu">
            <li><a class="app-menu__item active" href="{{ url('itd/users/index') }}"><i class="app-menu__icon fa fa-user-circle-o"></i><span class="app-menu__label">Users</span></a></li>
            <li><a class="app-menu__item active" href="{{ url('itd/logtimes/index') }}"><i class="app-menu__icon fa fa-list-ul"></i><span class="app-menu__label">User Reports</span></a></li>
            <li><a class="app-menu__item active" href="{{ url('itd/faq') }}"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">FAQs</span></a></li>
        </ul>

    </aside>

{{--GASD------------------------------------------------------------}}
@elseif (Auth::check() && Auth::user()->userRoleID == 2)
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        {{--<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">--}}
        {{--<div>--}}
        {{--<p class="app-sidebar__user-name">John Doe</p>--}}
        {{--<p class="app-sidebar__user-designation">Frontend Developer</p>--}}
        {{--</div>--}}
        {{--</div>--}}
        <ul class="app-menu">
            <li><a class="app-menu__item active" href="{{ url('itd/users/index') }}"><i class="app-menu__icon fa fa-user-circle-o"></i><span class="app-menu__label">Users</span></a></li>
            <li><a class="app-menu__item active" href="{{ url('itd/logtimes/index') }}"><i class="app-menu__icon fa fa-list-ul"></i><span class="app-menu__label">User Reports</span></a></li>
            <li><a class="app-menu__item active" href="{{ url('itd/faq') }}"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">FAQs</span></a></li>
        </ul>

    </aside>

{{--REGISTRAR------------------------------------------------------------}}
@elseif (Auth::check() && Auth::user()->userRoleID == 3)
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        {{--<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">--}}
        {{--<div>--}}
        {{--<p class="app-sidebar__user-name">John Doe</p>--}}
        {{--<p class="app-sidebar__user-designation">Frontend Developer</p>--}}
        {{--</div>--}}
        {{--</div>--}}
        <ul class="app-menu">
            <li><a class="app-menu__item active" href="{{ url('itd/users/index') }}"><i class="app-menu__icon fa fa-user-circle-o"></i><span class="app-menu__label">Users</span></a></li>
            <li><a class="app-menu__item active" href="{{ url('itd/logtimes/index') }}"><i class="app-menu__icon fa fa-list-ul"></i><span class="app-menu__label">User Reports</span></a></li>
            <li><a class="app-menu__item active" href="{{ url('itd/faq') }}"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">FAQs</span></a></li>
        </ul>

    </aside>

{{--ITD------------------------------------------------------------}}
@elseif (Auth::check() && Auth::user()->userRoleID == 4)
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
     {{--<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">--}}
    {{--<div>--}}
        {{--<p class="app-sidebar__user-name">John Doe</p>--}}
        {{--<p class="app-sidebar__user-designation">Frontend Developer</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    <ul class="app-menu">
        <li><a class="app-menu__item active" href="{{ url('itd/users/index') }}"><i class="app-menu__icon fa fa-user-circle-o"></i><span class="app-menu__label">Users</span></a></li>
        {{--<li><a class="app-menu__item active" href="{{ url('itd/logtimes/index') }}"><i class="app-menu__icon fa fa-list-ul"></i><span class="app-menu__label">User Reports</span></a></li>--}}
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">User Reports</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{ url('itd/logtimes/index') }}"><i class="icon fa fa-circle-o"></i> Audit Logs</a></li>
            <li><a class="treeview-item" href="{{ url('itd/users/activeUsers') }}"><i class="icon fa fa-circle-o"></i> Active Users</a></li>
        </ul>
        <li><a class="app-menu__item active" href="{{ url('itd/faq') }}"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">FAQs</span></a></li>
    </ul>

</aside>
@endif
{{--<!-- Sidebar menu-->--}}
{{--<div class="app-sidebar__overlay" data-toggle="sidebar"></div>--}}
{{--<aside class="app-sidebar">--}}
    {{-- <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">--}}
    {{--<div>--}}
        {{--<p class="app-sidebar__user-name">John Doe</p>--}}
        {{--<p class="app-sidebar__user-designation">Frontend Developer</p>--}}
    {{--</div>--}}
    {{--</div> --}}
    {{--<ul class="app-menu">--}}
        {{--<li><a class="app-menu__item active" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Users</span></a></li>--}}
        {{--<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">User Reports</span><i class="treeview-indicator fa fa-angle-right"></i></a>--}}
            {{--<ul class="treeview-menu">--}}
                {{--<li><a class="treeview-item" href="registrar/logtimes/index"><i class="icon fa fa-circle-o"></i> Audit Logs</a></li>--}}
                {{--<li><a class="treeview-item" href="registrar/" target="_blank" rel="noopener"><i class="icon fa fa-circle-o"></i> Font Icons</a></li>--}}
                {{--<li><a class="treeview-item" href="ui-cards.html"><i class="icon fa fa-circle-o"></i> Cards</a></li>--}}
                {{--<li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Widgets</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
    {{--</ul>--}}

{{--</aside>--}}

