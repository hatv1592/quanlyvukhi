var app = app || {};

(function(app) {
    app.nhomvukhi = {
        delete: function(id) {
            return app.dialog.confirmDelete().then(function() {
                return app.API().delete('/quantri/danhmucvukhi/nhomvukhi/' + id);
            }).then(function() {
                return sweetAlert({
                    title: 'Đã xóa!',
                    text: 'Nhóm vũ khí đã bị xóa!',
                    type: 'success'
                });
            }).catch(function(error) {
                if (error === 'cancel' || error === 'overlay') {
                    return;
                }

                return sweetAlert({
                    title: 'Không xóa được!',
                    text: 'Có thể đã phát sinh nguyên nhân gì đó khiến việc xóa không thành công!',
                    type: 'error'
                });
            });
        }
    };
})(app);
