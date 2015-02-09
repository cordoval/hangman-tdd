window.app
    .config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {controller: 'IndexController', templateUrl: 'index.html'})
            .when('/games/:id', {controller: 'ViewController', templateUrl: 'view.html'})
            .otherwise({
                redirectTo: '/'
            })
        ;
    }])
;
