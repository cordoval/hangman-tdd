window.app
    .config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }])
;

window.app.run(function($rootScope) {
    $rootScope.routingPrefix = window.routingPrefix;
});
