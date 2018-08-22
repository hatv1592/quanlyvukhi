<div class="row" style="
    font-family: Time new Roman;
    font-size: 16px; position: relative; font-weight: bold">
    <div class="row text-center">
        <p class="text-center" style="text-transform: uppercase;font-size: 16px">Cộng hòa xã hội chủ nghĩa việt
            nam</p>

        <p class="text-center" style="font-weight: bold;font-size: 16px">Độc lập - Tự do - Hạnh phúc</p>
    </div>
    <div style="text-transform: uppercase; position: absolute;top: 0px;left: 60px;font-weight: bold; text-align: center">
        <p>{{$input['donvi_captren']}}.</p>

        <p>{{$input['donvi_name']}}</p>
    </div>
    <div class="row text-center">
        <div class="">
            <div style="padding-top:20px; margin:auto;text-align: center; font-size: 18px;text-transform: uppercase;">
                {{$title}}
            </div>
        </div>
        {{--<p class="text-center" style="margin:auto"></p>--}}

        <div class="text-center" style="margin:auto; font-weight: normal; font-style: italic;">
            ( Từ ngày {{date('d', $input['from_time_stamp'])}}/{{date('m', $input['from_time_stamp'])}}
            /{{date('Y', $input['from_time_stamp'])}}
            đến ngày {{date('d', $input['to_time_stamp'])}}/{{date('m', $input['to_time_stamp'])}}
            /{{date('Y', $input['to_time_stamp'])}} )
        </div>
    </div>
</div>