var app = app || {};

(function(app) {
    app.components = {
        Pagination: {
            data: function () {
                return {
                    pages: [],
                    totalPage: 0
                };
            },

            props: {
                /**
                 * Current page to display
                 */
                currentPage: {
                    type: Number,
                    default: 1
                },

                /**
                 * Total items
                 */
                total: {
                    type: Number,
                    default: 0
                },

                onPageChanged: Function,

                /**
                 * Current item per page to display
                 */
                perPage: {
                    type: Number,
                    default: 10
                }
            },

            ready: function() {
                this.recalculatePages();
            },

            computed: {
                totalPage: function() {
                    return Math.ceil(this.total / this.perPage);
                }
            },

            watch: {
                total: function() {
                    if (this.totalPage < this.currentPage) {
                        this.currentPage = this.totalPage;
                        this.gotoPage(this.currentPage);
                    }
                },

                'totalPage + currentPage'() {
                    this.recalculatePages();
                }
            },

            methods: {
                /**
                 * Set current page to a specific value
                 *
                 * @param {int} page
                 */
                gotoPage: function(page) {
                    if (page < 1 || page > this.totalPage) {
                        return;
                    }

                    this.currentPage = page;

                    if (this.onPageChanged instanceof Function) {
                        this.onPageChanged(page);
                    }
                },

                /**
                 * Recalculate start page and end page when total page and current page on changing
                 * When clicking the page number next 4 pages from that page number is shown
                 */
                recalculatePages: function() {
                    const visiblePageNumber = 10;
                    const nextPageNumber = 4;
                    let startPage = 0;
                    let endPage = 0;
                    let pageList = [];

                    if (this.totalPage > 1) {
                        if (this.totalPage < visiblePageNumber) {
                            startPage = 1;
                            endPage = this.totalPage;
                        } else if (this.currentPage <= (visiblePageNumber / 2).toFixed()) {
                            startPage = 1;
                            endPage = startPage + (visiblePageNumber - 1);
                        } else if (this.currentPage >= this.totalPage - nextPageNumber) {
                            endPage = this.totalPage;
                            startPage = this.totalPage - (visiblePageNumber - 1);
                        } else {
                            startPage = this.currentPage - (visiblePageNumber / 2).toFixed();
                            endPage = startPage + (visiblePageNumber - 1);
                        }

                        for (let i = startPage; i <= endPage; i++) {
                            pageList.push(i);
                        }
                    }

                    this.pages = pageList;
                }
            },

            template:
            '<div v-show="total > perPage" class="pagination-wrapper">' +
            '<nav>' +
            '<ul class="pagination">' +
            '<li :class="{\'disabled\': currentPage <= 1}">' +
            '<a href="" @click.prevent="gotoPage(1)">First page</a>' +
            '</li>' +
            '<li :class="{\'disabled\': currentPage <= 1}">' +
            '<a href="" @click.prevent="gotoPage(currentPage - 1)">' +
            '<span aria-hidden="true">&laquo; Prev</span>' +
            '</a>' +
            '</li>' +

            '<li v-for="page in pages" :class="{\'active\': page === currentPage}">' +
            '<a href="" @click.prevent="gotoPage(page)">{{ page }}</a>' +
            '</li>' +

            '<li :class="{\'disabled\': currentPage >= totalPage}">' +
            '<a href="" @click.prevent="gotoPage(currentPage + 1)">' +
            '<span aria-hidden="true">Next &raquo;</span>' +
            '</a>' +
            '</li>' +

            '<li :class="{\'disabled\': currentPage >= totalPage}">' +
            '<a href="" @click.prevent="gotoPage(totalPage)">Last page</a>' +
            '</li>' +
            '</ul>' +
            '</nav>' +
            '</div>'
        },

        TableList: {
            props: ['data'],

            methods: {
                total: function(vukhi) {
                    return vukhi.level.level_1 + vukhi.level.level_2 + vukhi.level.level_3
                        + vukhi.level.level_4 + vukhi.level.level_5;
                },

                levelSum: function(data, level) {
                    var self = this;
                    var sum = 0;

                    data.forEach(function(item) {
                        sum += level === 6 ? self.total(item) : item.level['level_' + level];
                    });

                    return sum.toLocaleString();
                }
            },

            template:
            '<table class="table table-bordered table-striped table-custom">' +
            '<thead>' +
            '<tr>' +
            '<th class="text-center width-percent-5" rowspan="2">#</th>' +
            '<th class="text-left" rowspan="2">Tên vũ khí</th>' +
            '<th class="text-left" rowspan="2">NSX</th>' +
            '<th class="text-left" rowspan="2">ĐVT</th>' +
            '<th class="text-left" rowspan="2">Số hiệu</th>' +
            '<th class="text-center" colspan="6">Số lượng từng cấp</th>' +
            '<th class="text-left" rowspan="2">Để ở kho</th>' +
            '</tr>' +
            '<tr>' +
            '<th class="text-center">C1</th>' +
            '<th class="text-center">C2</th>' +
            '<th class="text-center">C3</th>' +
            '<th class="text-center">C4</th>' +
            '<th class="text-center">C5</th>' +
            '<th class="text-center">+</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +
            '<tr v-for="vukhi in data">' +
            '<th class="text-right">{{ vukhi.id }}</th>' +
            '<th class="text-left">{{ vukhi.vukhi }}</th>' +
            '<th class="text-left">{{ vukhi.nuocsanxuat }}</th>' +
            '<th class="text-left">{{ vukhi.donvitinh }}</th>' +
            '<th class="text-left"></th>' +
            '<th class="text-right">{{ vukhi.level.level_1 }}</th>' +
            '<th class="text-right">{{ vukhi.level.level_2 }}</th>' +
            '<th class="text-right">{{ vukhi.level.level_3 }}</th>' +
            '<th class="text-right">{{ vukhi.level.level_4 }}</th>' +
            '<th class="text-right">{{ vukhi.level.level_5 }}</th>' +
            '<th class="text-right">{{ total(vukhi) }}</th>' +
            '<th class="text-left">{{ vukhi.donvi }}</th>' +
            '</tr>' +
            '<tr>' +
            '<th class="text-center" colspan="5">Tổng cộng</th>' +
            '<th class="text-right">{{ levelSum(data, 1) }}</th>' +
            '<th class="text-right">{{ levelSum(data, 2) }}</th>' +
            '<th class="text-right">{{ levelSum(data, 3) }}</th>' +
            '<th class="text-right">{{ levelSum(data, 4) }}</th>' +
            '<th class="text-right">{{ levelSum(data, 5) }}</th>' +
            '<th class="text-right">{{ levelSum(data, 6) }}</th>' +
            '<th class="text-left"></th>' +
            '</tr>' +
            '</tbody>' +
            '</table>'
        },

        Total: {
            props: ['data', 'text'],

            template: '<div class="form-group">Tổng số: <strong>{{ data.length }}</strong> ({{ text }})</div>'
        },

        SelectBox: {
            props: ['data', 'model', 'isDisabled'],

            data: function() {
                return {
                    selectedValue: '',
                    loading: false
                };
            },

            ready: function() {
                this.loading = this.isDisabled;
            },

            watch: {
                selectedValue: function (value) {
                    if (value === '') {
                        return;
                    }

                    this.$dispatch(this.model, value);
                }
            },

            template: '<select class="form-control" v-model="selectedValue" :disabled="loading">' +
            '<option value="">Chọn</option>' +
            '<option value="{{ key }}" v-for="(key, value) in data">{{ value }}</option>' +
            '</select>'
        },

        NhapkhoList: {
            props: ['data'],

            template:
            '<table class="table table-bordered table-striped table-custom">' +
            '<thead>' +
            '<tr>' +
            '<th class="text-center width-percent-5">#</th>' +
            '<th class="text-left">Số lệnh</th>' +
            '<th class="text-center">Ngày thực hiện</th>' +
            '<th class="text-left">Đơn vị xuất</th>' +
            '<th class="text-left">Đơn vị nhập</th>' +
            '<th class="text-left">Lý do nhập kho</th>' +
            '<th class="text-center">In LNK</th>' +
            '<th class="text-center">Ghi chú</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +
            '<tr v-for="nhapkho in data">' +
            '<th class="text-right">{{ nhapkho.id }}</th>' +
            '<th class="text-left">{{ nhapkho.solenh }}</th>' +
            '<th class="text-center">{{ nhapkho.ngaythuchien }}</th>' +
            '<th class="text-left">{{ nhapkho.donvixuat }}</th>' +
            '<th class="text-left">{{ nhapkho.donvinhap }}</th>' +
            '<th class="text-left">{{ nhapkho.lydonhapkho }}</th>' +
            '<th class="text-center">' +
                '<a target="_blank" href="/xuatnhap/nhapkho/print/{{ nhapkho.id }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>' +
            '</th>' +
            '<th class="text-center"></th>' +
            '</tr>' +
            '</tbody>' +
            '</table>'
        },

        XuatkhoList: {
            props: ['data'],

            template:
            '<table class="table table-bordered table-striped table-custom">' +
            '<thead>' +
            '<tr>' +
            '<th class="text-center width-percent-5">#</th>' +
            '<th class="text-left">Số lệnh</th>' +
            '<th class="text-center">Ngày thực hiện</th>' +
            '<th class="text-left">Đơn vị xuất</th>' +
            '<th class="text-left">Đơn vị nhập</th>' +
            '<th class="text-left">Lý do xuất kho</th>' +
            '<th class="text-center">In LNK</th>' +
            '<th class="text-center">Ghi chú</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +
            '<tr v-for="xuatkho in data">' +
            '<th class="text-right">{{ xuatkho.id }}</th>' +
            '<th class="text-left">{{ xuatkho.solenh }}</th>' +
            '<th class="text-center">{{ xuatkho.ngaythuchien }}</th>' +
            '<th class="text-left">{{ xuatkho.donvixuat }}</th>' +
            '<th class="text-left">{{ xuatkho.donvinhap }}</th>' +
            '<th class="text-left">{{ xuatkho.lydoxuatkho }}</th>' +
            '<th class="text-center">' +
            '<a target="_blank" href="/xuatnhap/xuatkho/print/{{ xuatkho.id }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>' +
            '</th>' +
            '<th class="text-center"></th>' +
            '</tr>' +
            '</tbody>' +
            '</table>'
        },

        Datepicker: {
            props: ['model'],

            data: function() {
                return {
                    textValue: ''
                }
            },

            watch: {
                textValue: function() {
                    this.$dispatch(this.model, this.textValue);
                }
            },

            template: '<input type="text" v-datepicker="textValue" class="form-control" v-model="textValue">'
        },

        InputText: {
            props: ['model'],

            data: function() {
                return {
                    textValue: ''
                }
            },

            watch: {
                textValue: function() {
                    this.$dispatch(this.model, this.textValue);
                }
            },

            template: '<input type="text" class="form-control" v-model="textValue" debounce="500">'
        }
    };
})(app);
