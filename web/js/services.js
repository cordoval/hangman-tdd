window.app
    .service('gameRepository', ['$http', function ($http) {
        var userRequest = function(method, url, callback, data) {
            data = data || null;
            $http({
                method: method,
                url: window.routingPrefix + url,
                data: data,
            }).success(function (data, status, headers) {
                callback(data);
            }).error(function (data, status, headers) {
                alert('An error occurred');
            });
        };

        this.create = function (callback) {
            var url = '/games';
            userRequest('POST', url, callback);
        };

        this.getAllGames = function(callback) {
            var url = '/games';
            userRequest('GET', url, callback);
        };

        this.getGame = function (id, callback) {
            var url = '/games/' + id;
            userRequest('GET', url, callback);
        };

        this.guessChar = function (id, character, callback) {
            var url =  '/games/' + id;
            var data = {'char': character};
            userRequest('POST', url, callback, data);
        };
    }])
;
