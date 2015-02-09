(function () {
    var routing = {
        dev: '/app_dev.php',
        prod: ''
    };

    var env = 'dev';
    window.routingPrefix = routing[env];
})();

window.app = angular.module('Qandidate', ['ngRoute'])
    .config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[').endSymbol(']]');
    }])
;
