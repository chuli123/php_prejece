/**
 * Created by Administrator on 2017/7/24.
 */
var app = angular.module('myLogin',[]);
app.controller("myLogin",function($scope,$http){
    $scope.formData = {};
    $scope.loginForm = function(){
        $http.post('login.php', $scope.formData)
            .then(function(result){
                $scope.data = result.data[0];
                if($scope.data.code = 1){
                    alert($scope.data.msg);
                }else{
                    alert($scope.data.msg);
                }
            });
    }
});