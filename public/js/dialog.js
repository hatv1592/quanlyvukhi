var app = app || {};

(function(app) {
    app.dialog = {
        confirmDelete: function () {
            return sweetAlert({
                title: 'Bạn có chắc chắn?',
                text: "Bạn không thể hồi phục lại những gì đã xóa!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy bỏ',
                allowOutsideClick: false
            });
        }
    };
})(app);