<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap -->
    <link href="{{URL::asset('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::asset('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{URL::asset('public/css/custom.css')}}" rel="stylesheet">
</head>

<body style="background:#F7F7F7;">
<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class=" form">
            <section class="login_content">
                <form action="{{route('login.dologin')}}" method="post">
                    <h1>Đăng nhập</h1>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div>
                        <input name="name" type="text" class="form-control" placeholder="Username" required=""/>
                    </div>
                    <div>
                        <input name="password" type="password" class="form-control" placeholder="Password" required=""/>
                    </div>
                    <div>
                        <input class="btn btn-default submit" type="submit" value="Đăng nhập">
                        {{--<a class="btn btn-default submit" href="index.html">Đăng nhập</a>--}}
                        {{--<a class="reset_pass" href="#">Lost your password?</a>--}}
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">

                        {{--<p class="change_link">New to site?--}}
                        {{--<a href="#toregister" class="to_register"> Create Account </a>--}}
                        {{--</p>--}}
                        {{--<div class="clearfix"></div>--}}
                        {{--<br/>--}}
                        <div>
                            {{--<h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>--}}

                            <p>©2016 All Rights Reserved. Phần mềm quản lý vũ khí</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <div id="register" class=" form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required=""/>
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required=""/>
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required=""/>
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">

                        <p class="change_link">Already a member ?
                            <a href="#tologin" class="to_register"> Log in </a>
                        </p>
                        <div class="clearfix"></div>
                        <br/>
                        <div>
                            <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                            <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and
                                Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>