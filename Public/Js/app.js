/**
 * Created by Administrator on 2017/7/27.
 */
var app = angular.module('myapp',[]);
app.config(['$routeProvider',function($routeProvider){
    $routeProvider
        .when('/login',{
            templateUrl: 'login.html'
        })
        .otherwise({
            redirectTo:'reg.html'
        });
}]);