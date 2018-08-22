var app = app || {};

app.config = {
    itemPerPage: 10
};

Vue.directive('datepicker', {
    bind: function () {
        var vm = this.vm;
        var key = this.expression;
        $(this.el).daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            format: 'DD-MM-YYYY'
        }).on('apply.daterangepicker', function(e) {
            vm.$set(key, e.target.value);
        });
    },

    update: function (val) {
        $(this.el).data('daterangepicker').setStartDate(val);
    }
});
