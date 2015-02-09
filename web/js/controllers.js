window.app
    .controller('IndexController', function () {
        // renders just default start game view
    })
    .controller('CreateController', ['$scope', '$window', '$location', 'gameRepository', function ($scope, $window, $location, gameRepository) {
        $scope.create = function () {
            gameRepository.create(function (game) {
                $location.path('/games/' + game.uuid);
            });
        };
    }])
    .controller('ViewController', ['$scope', '$routeParams', 'gameRepository', function ($scope, $routeParams, gameRepository) {
        $scope.game = {};
        $scope.form = {attempted_char: ''};

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
