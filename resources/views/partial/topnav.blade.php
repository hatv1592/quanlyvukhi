<style>
    .top_nav .navbar-right {
        width: 40%;
    }
</style>
<div class="nav_menu">
    <nav class="" role="navigation">
        <div class="nav toggle">
            <a id="menu_toggle">
                <i class="fa fa-bars">
                </i>
            </a>
        </div>
        <ul class="nav navbar-nav navbar-left" style="width: 43%">
            <div class="page-title">
                <div class="">
                    <div class="col-md-10 col-sm-5 col-xs-12 form-group pull-left top_search">
                        <div class="input-group">
                            <input class="form-control" placeholder="Nhập trên Vũ khí cần tra cứu" type="text">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        Go!
                                    </button>
                                </span>
                            </input>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="">
                <a aria-expanded="false" class="user-profile dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                    <img alt="" src="{{url::asset('public/production/images/img.jpg')}}">
                    {{ Auth::user()->name }}
                        <span class=" fa fa-angle-down">
                        </span>
                    </img>
                </a>

                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    {{--<li>--}}
                        {{--<a href="javascript:;">--}}
                            {{--Profile--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="javascript:;">--}}
                            {{--<span class="badge bg-red pull-right">--}}
                                {{--50%--}}
                            {{--</span>--}}
                            {{--<span>--}}
                                {{--Settings--}}
                            {{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="javascript:;">--}}
                            {{--Help--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="{{ url('/logout') }}">
                            <i class="fa fa-sign-out pull-right">
                            </i>
                            Log Out
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown" role="presentation">
                {{--<a aria-expanded="false" class="dropdown-toggle info-number" data-toggle="dropdown" href="javascript::void(0);">--}}
                    {{--<i class="fa fa-envelope-o">--}}
                    {{--</i>--}}
                    {{--<span class="badge bg-green">--}}
                        {{--6--}}
                    {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu list-unstyled msg_list" id="menu1" role="menu">--}}
                    {{--<li>--}}
                        {{--<a>--}}
                            {{--<span class="image">--}}
                                {{--<img alt="Profile Image" src="../production/images/img.jpg"/>--}}
                            {{--</span>--}}
                            {{--<span>--}}
                                {{--<span>--}}
                                    {{--Tương Tư Hiếu--}}
                                {{--</span>--}}
                                {{--<span class="time">--}}
                                    {{--3 mins ago--}}
                                {{--</span>--}}
                            {{--</span>--}}
                            {{--<span class="message">--}}
                                {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                            {{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a>--}}
                            {{--<span class="image">--}}
                                {{--<img alt="Profile Image" src="../production/images/img.jpg"/>--}}
                            {{--</span>--}}
                            {{--<span>--}}
                                {{--<span>--}}
                                    {{--Uông Sĩ Quyền--}}
                                {{--</span>--}}
                                {{--<span class="time">--}}
                                    {{--36 mins ago--}}
                                {{--</span>--}}
                            {{--</span>--}}
                            {{--<span class="message">--}}
                                {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                            {{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a>--}}
                            {{--<span class="image">--}}
                                {{--<img alt="Profile Image" src="{{url::asset('public/production/images/img.jpg')}}"/>--}}
                            {{--</span>--}}
                            {{--<span>--}}
                                {{--<span>--}}
                                    {{--Văn Dũng--}}
                                {{--</span>--}}
                                {{--<span class="time">--}}
                                    {{--54 mins ago--}}
                                {{--</span>--}}
                            {{--</span>--}}
                            {{--<span class="message">--}}
                                {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                            {{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a>--}}
                            {{--<span class="image">--}}
                                {{--<img alt="Profile Image" src="{{url::asset('public/production/images/img.jpg')}}"/>--}}
                            {{--</span>--}}
                            {{--<span>--}}
                                {{--<span>--}}
                                    {{--Đào Văn Đoan--}}
                                {{--</span>--}}
                                {{--<span class="time">--}}
                                    {{--1 hour ago--}}
                                {{--</span>--}}
                            {{--</span>--}}
                            {{--<span class="message">--}}
                                {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                            {{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<div class="text-center">--}}
                            {{--<a href="inbox.html">--}}
                                {{--<strong>--}}
                                    {{--See All Alerts--}}
                                {{--</strong>--}}
                                {{--<i class="fa fa-angle-right">--}}
                                {{--</i>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        {{--</ul>--}}
    </nav>
</div>