var app = app || {};

(function(app, $) {
    var request = function(url, method, data) {
        // Token to request to server
        var _token = $('meta[name=csrf-token]').attr('content');

        data = data || {};

        return new Promise(function(resolve, reject) {
            $.ajax({
                url: url,
                type: method,
                beforeSend: function(req) {
                    req.setRequestHeader('X-CSRF-TOKEN', _token);
                },
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                data: data,
                success: function(result) {
                    resolve(result);
                },
                error: function(error) {
                    reject(error);
                }
            })
        });
    };

    app.API = function() {
        return {
            get: function (url, data) {
                return request(url, 'GET', data);
            },

            post: function(url, data) {
                return request(url, 'POST', data);
            },

            delete: function(url) {
                return request(url, 'DELETE');
            }
            // maybe apply: PUT, DELETE, PATCH
        };
    };
})(app, $);