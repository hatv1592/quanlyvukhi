
@if(request('export', 0) == 0)
    <div class="text-center hidden-print" style="padding: 10px" id="btn_export">
        <button style="width: 100px;" class="btn btn-primary" type="button" onclick="location.href=location.href + '&export=1&export_word=1'">Export Word
        </button>
        <button style="width: 100px;" class="btn btn-warning" type="button" onclick="location.href=location.href + '&export=1&export_excel=1'">Export Excel
        </button>
        <button style="width: 100px;" class="btn btn-info" type="button" onclick="window.print();">In ấn
        </button>
    </div>
@endif