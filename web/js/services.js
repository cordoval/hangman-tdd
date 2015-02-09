window.app
    .service('gameRepository', ['$http', function ($http) {
        this.game = {};

        var self = this;
        this.create = function (callback) {
            $http({
                method: 'POST',
                url: window.routingPrefix + '/games'
            }).success(function (game, status, headers) {
                self.game = game;
                callback(game);
            }).error(function (data, status, headers) {
                alert('An error occurred');
            });
        };

        this.getGame = function (id, callback) {
            $http({
                method: 'GET',
                url: window.routingPrefix + '/games/' + id
            }).success(function (game, status, headers) {
                callback(game);
            }).error(function (data, status, headers) {
                alert('An error occurred');
            });
        };

        this.guessChar = function (id, char, callback) {
            $http({
                method: 'POST',
                url: window.routingPrefix + '/games/' + id,
                data: {'char': char}
            }).success(function (data, status, headers) {
                callback(data);
            }).error(function (data, status, headers) {
                alert('An error occurred');
            });
        };
    }])
;
