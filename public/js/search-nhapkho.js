(function () {
    new Vue({
        el: '#search-nhapkho',
        data: function() {
            return {
                loading: false,
                data: [],
                params: {
                    donvi_id: null,
                    lydonhapkho_id: null,
                    solenh: null,
                    from_date: null,
                    to_date: null,
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
                self.params.donvi_id = value || 0;
            });

            this.$on('lydonhapkho_id', function (value) {
                self.params.lydonhapkho_id = value || 0;
            });

            this.$on('solenh', function (value) {
                self.params.solenh = value;
            });

            this.$on('from_date', function (value) {
                self.params.from_date = value;
            });

            this.$on('to_date', function (value) {
                self.params.to_date = value;
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
                app.API().get('/api/v1/search/lenhnhapkho', this.params).then(function(response) {
                    self.total = response.total;
                    self.data = response.list;
                    self.loading = false;
                }).catch(function() {
                    self.loading = false;
                });
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
            'table-list': app.components.NhapkhoList,
            'total': app.components.Total,
            'Pagination': app.components.Pagination,
            'Datepicker': app.components.Datepicker,
            'InputText': app.components.InputText
        }
    });
})();
