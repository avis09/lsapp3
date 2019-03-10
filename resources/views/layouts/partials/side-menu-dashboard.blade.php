<!-- Sidebar menu-->

{{--USER (student or staff)------------------------------------------------------------}}
@if (Auth::check() && Auth::user()->userRoleID == 1)
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <i class="fas fa-user-circle mr-3 ml-1 fa-3x"></i>
            <!-- <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"> -->
        <div>
        <p class="app-sidebar__user-name">{{ auth()->user()->firstName.' '.auth()->user()->lastName }}</p>
        <p class="app-sidebar__user-designation">Student</p>
        </div>
        </div>
        <ul class="app-menu">
            <li id="menu-reservation" class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i>
                    <span class="app-menu__label">Reservation</span><i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a id="reservation-list" class="treeview-item" href="{{url('student/schedules/list') }}"><i class="icon fa fa-circle-o"></i> Reservation List</a></li>
                    <li><a id="calendar" class="treeview-item" href="{{ url('student/schedules/calendar') }}"><i class="icon fa fa-circle-o"></i> Calendar</a></li>
                </ul>
            </li>
             <li><a id="menu-venue-gallery" class="app-menu__item" href="{{ url('student/venue-gallery') }}"><i class="app-menu__icon fas fa-images"></i><span class="app-menu__label">Venues Gallery</span></a></li>
            <li><a id="menu-feedbacks" class="app-menu__item" href="{{ url('student/feedback') }}"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">Send Feedback</span></a></li>
            <li><a id="menu-faqs" class="app-menu__item" href="{{ url('student/faq') }}"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">FAQ</span></a></li>
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
            <li class="treeview">
                <a id="menu-users" class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i>
                    <span class="app-menu__label">Reservation</span><i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{url('gasd/schedules/create2') }}"><i class="icon fa fa-circle-o"></i> Reserve Venue</a></li>
                    <li><a class="treeview-item" href="{{ url('gasd/schedules/index2') }}"><i class="icon fa fa-circle-o"></i> Reservations</a></li>
                    <li><a class="treeview-item" href="{{ url('gasd/schedules/index2') }}"><i class="icon fa fa-circle-o"></i> Calendar</a></li>
                </ul>
            </li>
            <li><a class="app-menu__item" href="{{ url('gasd/faq') }}"><i class="app-menu__icon fa fa-comment"></i>FAQ</a></li>
            <li><a class="app-menu__item" href="{{url('gasd/venues/index2') }}"><i class="app-menu__icon fa fa-soccer-ball-o"></i>Court</a></li>
            <li><a class="treeview-item" href="{{url('registrar/feedbacks/index') }}"><i class="icon fa fa-comment"></i>Feedback</a></li>
            <li class="treeview">
                <a id="menu-users" class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i>
                    <span class="app-menu__label">Room Reservation</span><i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{url('gasd/schedules/create2') }}"><i class="icon fa fa-circle-o"></i> Reservation Request</a></li>
                    <li><a class="treeview-item" href="{{ url('gasd/schedules/index2') }}"><i class="icon fa fa-circle-o"></i> Reserved Venue</a></li>
                    <li><a class="treeview-item" href="{{ url('gasd/gallery/index2') }}"><i class="icon fa fa-circle-o"></i> Venue Gallery</a></li>
                </ul>
            </li>
        </ul>

    </aside>

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
            <li>
                <a id="menu-venues" class="app-menu__item" href="{{ url('registrar/venues/index') }}"><i class="app-menu__icon fas fa-school"></i> <span class="app-menu__label">Venues</span></a>
            </li>
            <li>
                <a id="menu-feedbacks" class="app-menu__item" href="{{ url('registrar/feedbacks/index') }}"><i class="app-menu__icon fa fa-list-ul"></i><span class="app-menu__label">FeedBacks</span></a>
            </li>
            <li><a class="app-menu__item" href="{{ url('registrar/faq') }}"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">FAQ</span></a></li>
            <li><a class="app-menu__item" href="{{url('gasd/venues/index2') }}"><i class="app-menu__icon fa fa-building"></i>Rooms</a></li>
            <li><a class="treeview-item" href="{{url('registrar/feedbacks/index') }}"><i class="icon fa fa-comment"></i>Feedback</a></li>
            <li class="treeview">
                <a id="menu-users" class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i>
                    <span class="app-menu__label">Room Reservation</span><i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{url('registrar/schedules/create') }}"><i class="icon fa fa-circle-o"></i> Reservation Request</a></li>
                    <li><a class="treeview-item" href="{{ url('registrar/schedules/index') }}"><i class="icon fa fa-circle-o"></i> Reserved Rooms</a></li>
                    <li><a class="treeview-item" href="{{ url('registrar/gallery/index') }}"><i class="icon fa fa-circle-o"></i> Room Gallery</a></li>
                </ul>
            </li>
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
        <li>
            <a id="menu-users" class="app-menu__item" href="{{ url('itd/users/index') }}"><i class="app-menu__icon fa fa-user-circle-o"></i><span class="app-menu__label">Users</span>
            </a>
        </li>
        <li id="menu-user-reports" class="treeview">
            <a id="menu-users" class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i>
                <span class="app-menu__label">User Reports</span><i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a id="audit-logs" class="treeview-item" href="{{ url('itd/accountlogs/index') }}"><i class="icon fa fa-circle-o"></i> Audit Logs</a></li>
                <li><a id="active-users" class="treeview-item" href="{{ url('itd/users/activeUsers') }}"><i class="icon fa fa-circle-o"></i> Active Users</a></li>
                <li><a id="archived-users" class="treeview-item" href="{{ url('itd/users/reports-archived-users') }}"><i class="icon fa fa-circle-o"></i> Archived Users</a></li>
            </ul>
        </li>
        <li>
            <a id="menu-faqs" class="app-menu__item" href="{{ url('itd/itdfaq') }}"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">FAQs</span></a>
        </li>
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

