window.app
    .controller('IndexController', ['$scope', 'gameRepository', function ($scope, gameRepository) {
        $scope.games = [];
        gameRepository.getAllGames(function(games) {
            $scope.games = games;
        });
    }])
    .controller('CreateController', ['$scope', '$location', 'gameRepository', function ($scope, $location, gameRepository) {
        $scope.create = function () {
            gameRepository.create(function (game) {
                $location.path('/games/' + game.uuid);
            });
        };
    }])
    .controller('ViewController', ['$scope', '$routeParams', 'gameRepository', function ($scope, $routeParams, gameRepository) {
        $scope.game = {};
        $scope.form = {
            attempted_char: '',
            //letters: "abcdefghijklmnopqrstuvwxyz".toCharArray(),
        };

        gameRepository.getGame($routeParams.id, function (game) {
            $scope.game = game;
        });

        $scope.guessChar = function () {
            gameRepository.guessChar($routeParams.id, $scope.form.attempted_char, function (data) {
                $scope.game = data.game;
            });

            $scope.form.attempted_char = '';
        };
    }])
;
