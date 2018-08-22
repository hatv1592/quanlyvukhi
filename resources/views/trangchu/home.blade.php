@extends('../master')

@section('content')
    <style>
        .slide img {
            max-width: 100%;
            max-height: 100%;
            margin: auto;
        }
    </style>
    <div class="container" style="min-height: 500px;">
        <div class="x_panel tile fixed_height_500">
            <div class="x_title">
{{--                <h2>Chào bạn <span style="color: red">{{Auth::user()->name}}</span></h2>--}}
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div style=" margin: auto; height:500px; width:1078px;max-width: 100%;max-height: 100%;" role="tabpanel"
                     class="tab-pane active" id="home">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"
                         data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div style=" height:500px; width:1078px;max-width: 100%;max-height: 100%;"
                             class="carousel-inner" role="listbox">
                            <div style=" height:500px; width:1078px" class="item active">
                                <img src="/public/images/imgVukhi/2jpg.jpg" alt="ảnh số 2">

                                <div class="carousel-caption">
                                    <h3>Súng máy Kord-5.45</h3>
                                    <p>Cỡ nòng 5,54mm - Tốc độ bắn 800-900 phát /phút</p>
                                </div>
                            </div>
                            <div style=" height:500px; width:1078px;max-width: 100%;max-height: 100%;" class="item">
                                <img src="/public/images/imgVukhi/3.jpg" alt="ảnh số 3">

                                <div class="carousel-caption">
                                    <h3>Ảnh số 2</h3>
                                    <p>Mô tả cho ảnh số 2</p>
                                </div>
                            </div>
                            <div style=" height:500px; width:1078px;max-width: 100%;max-height: 100%;" class="item">
                                <img src="/public/images/imgVukhi/5.jpg" alt="ảnh số 5">
                                <div class="carousel-caption">
                                    <h3>Ảnh số 3</h3>
                                    <p>Mô tả cho ảnh số 3</p>
                                </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button"
                           data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button"
                           data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
