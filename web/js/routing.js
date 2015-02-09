window.app
    .config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
        // $locationProvider.html5Mode(true);

        $routeProvider
            .when('/', {controller: 'IndexController', templateUrl: 'index.html'})
            .when('/games/:id', {controller: 'ViewController', templateUrl: 'view.html'})
            .otherwise({
                redirectTo: '/'
            })
        ;
    }])
;
