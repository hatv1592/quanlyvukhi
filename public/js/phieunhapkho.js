var app = app || {};

(function(app, $) {
    app.phieunhapkho = {
        defaultOption: '<option value="">Chọn</option>',

        onChangeWeaponSystem: function(el) {
            var id = el.value || el.val();

            if (!id) {
                return;
            }

            var callBackHandle = function(response) {
                var nhomvukhi = response[0];
                var nuocsanxuat = response[1];

                var nhomvukhiOptions = this.defaultOption;
                var nuocsanxuatOptions = this.defaultOption;

                nhomvukhi.forEach(function(item) {
                    nhomvukhiOptions += '<option value="' + item.nhomvukhi_id + '">' + item.nhomvukhi_name + '</option>';
                });

                nuocsanxuat.forEach(function(item) {
                    nuocsanxuatOptions += '<option value="' + item.nuocsanxuat_id + '">' + item.nuocsanxuat_name + '</option>';
                });

                $('#nhomvukhi')
                    .removeAttr("disabled")
                    .find('option')
                    .remove()
                    .end()
                    .append(nhomvukhiOptions)
                    .select2('val', '');
                $('#nuocsanxuat')
                    .removeAttr("disabled")
                    .find('option')
                    .remove()
                    .end()
                    .append(nuocsanxuatOptions)
                    .select2('val', '');
                $('#covukhi')
                    .attr("disabled", true)
                    .find('option')
                    .remove()
                    .end()
                    .append(this.defaultOption)
                    .select2('val', '');
                $('#vukhi')
                    .attr("disabled", true)
                    .find('option')
                    .remove()
                    .end()
                    .append(this.defaultOption)
                    .select2('val', '');

                this.onChangeToGetThuclucvukhi();
            };

            // Disable two combobox nhomvukhi and nuocsanxuat have depend by hevukhi when API call is loading
            $('#nhomvukhi').attr('disabled', true);
            $('#nuocsanxuat').attr('disabled', true);

            Promise.all([
                app.API().get('/api/v1/hevukhi/' + id + '/nhomvukhi'),
                app.API().get('/api/v1/hevukhi/' + id + '/nuocsanxuat')
            ]).then(callBackHandle.bind(this));
        },

        onChangeWeaponGroup: function (el) {
            var id = el.value;

            if (!id) {
                return;
            }

            var callBackHandle = function(response) {
                var options = this.defaultOption;

                response.forEach(function(covukhi) {
                    options += '<option value="' + covukhi.covukhi_id + '">' + covukhi.covukhi_name + '</option>';
                });

                $('#covukhi')
                    .removeAttr("disabled")
                    .find('option')
                    .remove()
                    .end()
                    .append(options)
                    .select2('val', '')

                $('#vukhi')
                    .attr("disabled", true)
                    .find('option')
                    .remove()
                    .end()
                    .append(this.defaultOption)
                    .select2('val', '');

                this.onChangeToGetThuclucvukhi();
            };

            // Disable covukhi combobox have depend by nhomvukhi when API call is loading
            $('#covukhi').attr('disabled', true);

            app.API().get('/api/v1/nhomvukhi/' + id + '/covukhi').then(callBackHandle.bind(this));
        },

        onChangeWeaponSize: function(el) {
            var id = el.value;

            if (!id) {
                return;
            }

            var callBackHandle = function(response) {
                var options = this.defaultOption;

                response.forEach(function(vukhi) {
                    options += '<option value="' + vukhi.vukhi_id + '">' + vukhi.vukhi_name + '</option>';
                });

                $('#vukhi')
                    .removeAttr("disabled")
                    .find('option')
                    .remove()
                    .end()
                    .append(options)
                    .select2('val', '');

                this.onChangeToGetThuclucvukhi();
            };

            // Disable vukhi combobox have depend by covukhi when API call is loading
            $('#vukhi').attr('disabled', true);

            app.API().get('/api/v1/covukhi/' + id + '/vukhi').then(callBackHandle.bind(this));
        },

        deleteVukhiInPhieunhapkho: function(id, storeKey) {
            return app.dialog.confirmDelete().then(function() {
                var url = '/xuatnhap/nhapkho/phieunhapkho/vukhi/' + parseInt(id) + '?nhapkho_key_temp=' + storeKey;
                return app.API().delete(url);
            }).then(function() {
                return sweetAlert({
                    title: 'Đã xóa!',
                    text: 'Vũ khi đã bị xóa!',
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
        },

        complete: function(storeKey) {
            var url = '/xuatnhap/nhapkho/phieunhapkho/complete?' + 'nhapkho_key_temp=' + storeKey;
            var form = $('#phieunhapkho');

            form.attr('action', url);
            return form.submit();
        },

        delete: function(id) {
            return app.dialog.confirmDelete().then(function() {
                return app.API().delete('/xuatnhap/nhapkho/phieunhapkho/' + id);
            }).then(function() {
                return sweetAlert({
                    title: 'Đã xóa!',
                    text: 'Phiếu nhập kho đã bị xóa!',
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
})(app, $);
