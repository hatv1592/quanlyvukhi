(function () {
    new Vue({
        el: '#search-thucluc-vukhi',
        data: function() {
            return {
                loading: false,
                data: [],
                params: {
                    donvi_id: null,
                    hevukhi_id: null,
                    vukhi_id: null,
                    nhomvukhi_id: null,
                    covukhi_id: null,
                    donvitinh_id: null,
                    nuocsanxuat_id: null,
                    level_1: null,
                    level_2: null,
                    level_3: null,
                    level_4: null,
                    level_5: null,
                    item_per_page: app.config.itemPerPage
                },
                currentPage: 1,
                itemPerPage: app.config.itemPerPage,
                total: 0
            };
        },

        ready: function() {
            var self = this;

            this.$on('donvi_id', function (value) {
                self.params.donvi_id = value;
            });

            this.$on('hevukhi_id', function (value) {
                self.params.hevukhi_id = value || 0;
                self.$refs.nhomvukhi.loading = true;
                self.$refs.nuocsanxuat.loading = true;
                Promise.all([
                    app.API().get('/api/v1/hevukhi/' + self.params.hevukhi_id + '/nhomvukhi'),
                    app.API().get('/api/v1/hevukhi/' + self.params.hevukhi_id + '/nuocsanxuat')
                ]).then(function(response) {
                    self.$refs.nhomvukhi.loading = false;
                    self.$refs.nhomvukhi.selectedValue = '';

                    self.$refs.nuocsanxuat.loading = false;
                    self.$refs.nuocsanxuat.selectedValue = '';

                    self.$refs.nhomvukhi.data = self.formatData(response[0], 'nhomvukhi_id', 'nhomvukhi_name');
                    self.$refs.nuocsanxuat.data = self.formatData(response[1], 'nuocsanxuat_id', 'nuocsanxuat_name');

                    self.$refs.vukhi.data = self.formatData([], 'vukhi_id', 'vukhi_name');
                    self.$refs.vukhi.loading = true;
                    self.$refs.vukhi.selectedValue = '';

                    self.$refs.covukhi.data = self.formatData([], 'covukhi_id', 'covukhi_name');
                    self.$refs.covukhi.selectedValue = '';
                    self.$refs.covukhi.loading = true;
                }).catch(function() {
                    self.$refs.nhomvukhi.loading = false;
                    self.$refs.nhomvukhi.selectedValue = '';

                    self.$refs.nuocsanxuat.loading = false;
                    self.$refs.nuocsanxuat.selectedValue = '';
                });
            });

            this.$on('vukhi_id', function (value) {
                self.params.vukhi_id = value;
            });

            this.$on('nhomvukhi_id', function (value) {
                self.params.nhomvukhi_id = value || 0;

                self.$refs.covukhi.loading = true;
                app.API().get('/api/v1/nhomvukhi/' + self.params.nhomvukhi_id + '/covukhi').then(function(response) {
                    self.$refs.covukhi.loading = false;
                    self.$refs.covukhi.data = self.formatData(response, 'covukhi_id', 'covukhi_name');
                    self.$refs.covukhi.selectedValue = '';

                    self.$refs.vukhi.data = self.formatData([], 'vukhi_id', 'vukhi_name');
                    self.$refs.vukhi.loading = true;
                    self.$refs.vukhi.selectedValue = '';
                }).catch(function() {
                    self.$refs.covukhi.loading = false;
                    self.$refs.covukhi.selectedValue = '';
                });
            });

            this.$on('covukhi_id', function (value) {
                self.params.covukhi_id = value || 0;

                self.$refs.vukhi.loading = true;
                app.API().get('/api/v1/covukhi/' + self.params.covukhi_id + '/vukhi').then(function(response) {
                    self.$refs.vukhi.loading = false;
                    self.$refs.vukhi.data = self.formatData(response, 'vukhi_id', 'vukhi_name');
                    self.$refs.vukhi.selectedValue = '';
                }).catch(function() {
                    self.$refs.vukhi.loading = false;
                    self.$refs.vukhi.selectedValue = '';
                });
            });

            this.$on('donvitinh_id', function (value) {
                self.params.donvitinh_id = value;
            });

            this.$on('nuocsanxuat_id', function (value) {
                self.params.nuocsanxuat_id = value;
            });

            this.$on('level_1', function (value) {
                self.params.level_1 = value;
            });

            this.$on('level_2', function (value) {
                self.params.level_2 = value;
            });

            this.$on('level_3', function (value) {
                self.params.level_3 = value;
            });

            this.$on('level_4', function (value) {
                self.params.level_4 = value;
            });

            this.$on('level_5', function (value) {
                self.params.level_5 = value;
            });

            // Load data
            this.loadData();
        },

        watch: {
            params: {
                handler: function() {
                    if (this.currentPage !== 1) {
                        this.currentPage = 1;
                    } else {
                        this.loadData();
                    }
                },
                deep: true
            },

            currentPage: function() {
                this.loadData();
            }
        },

        methods: {
            loadData: function() {
                if (!this.params) {
                    return;
                }

                var self = this;

                // set current page
                self.params.page = self.currentPage;

                self.loading = true;
                app.API().get('/api/v1/thuclucvukhi', this.params).then(function(response) {
                    self.total = response.total;
                    self.data = response.list;
                    self.loading = false;
                }).catch(function() {
                    self.loading = false;
                });
            },

            /**
             * Format data when change these combo box
             *
             * @param {Array} dataOriginal
             * @param {String} key
             * @param {String} value
             *
             * @returns {*}
             */
            formatData: function(dataOriginal, key, value) {
                if (dataOriginal.length === 0) {
                    return {};
                }

                var data = {
                    0: 'Chọn tất cả'
                };

                dataOriginal.forEach(function(item) {
                    data[item[key]] = item[value]
                });

                return data;
            },

            /**
             * Change current page
             *
             * @param {int} page
             */
            changePage: function(page) {
                this.currentPage = page;
            }
        },

        components: {
            'select-box': app.components.SelectBox,
            'table-list': app.components.TableList,
            'total': app.components.Total,
            'Pagination': app.components.Pagination
        }
    });
})();
