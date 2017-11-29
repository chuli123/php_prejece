/**
 * Created by Administrator on 2017/7/13.
 */
var app = angular.module('myApp',[]);
app.controller('myCtrl',function($scope,$http,$window){
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
    $scope.formData = {};
    $scope.processForm = function(){
        $http.post('reg.php', $scope.formData)
        .then(function (result) {  //正确请求成功时处理
            $scope.info = result.data[0];
            //console.log($scope.message);
            if($scope.info.code == 1){
                alert($scope.info.msg);
                $window.location.href = 'login.html';
            }else{
                alert($scope.info.msg);
            }
        });
    }

    $scope.checkName = function(uName){
        $scope.data = uName;
        $http.post('reg_ck.php',$scope.data)
            .then(function(result){
                console.info(result);
                $scope.data = result.data[0];
                if($scope.data.code ==1){
                    $scope.message = "用户名可以用";
                }else{
                    $scope.message = "该用户名已存在";
                }
            });
    }

});
app.directive('pwCheck',[function(){
    return {
        require:'ngModel',
        link:function(scope,elem,attrs,ctrl){
            var firstPassword = '#' + attrs.pwCheck;
            elem.add(firstPassword).on('keyup', function () {
                scope.$apply(function () {
                    var v = elem.val()===$(firstPassword).val();
                    ctrl.$setValidity('pwmatch', v);
                });
            });
        }
    }
}]);