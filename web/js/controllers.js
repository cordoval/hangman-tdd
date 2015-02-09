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
            letters: "abcdefghijklmnopqrstuvwxyz".split(''),
            submitting: false
        };

        gameRepository.getGame($routeParams.id, function (game) {
            $scope.game = game;
        });

        $scope.guessChar = function (attempted_char) {
            $scope.form.submitting = true;
            gameRepository.guessChar($routeParams.id, attempted_char, function (data) {
                $scope.game = data.game;
                $scope.form.submitting = false;
            });

            var charAt = $scope.form.letters.indexOf(attempted_char);
            var letters = $scope.form.letters;
            letters.splice(charAt, 1);
            $scope.form.letters = letters;
        };
    }])
;
