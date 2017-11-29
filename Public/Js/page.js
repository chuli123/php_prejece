/**
 * Created by Administrator on 2017/7/31.
 */
var app = angular.module('myApp',['tm.pagination']);
app.controller('myCtrl',['$scope','pageService',function($scope,pageService){
    var getList = function(){
        var postData = {
            pageIndex : $scope.pageConf.currentPage,
            pageSize : $scope.pageConf.itemPerPage
        }

        pageService.list(postData).then(function(result){
            $scope.pageConf.total = result.count;
            $scope.persons = result.items;
        });

    }

    $scope.pageConf = {
        currentPage:1,
        itemPerPage:5
    }

    $scope.$watch("pageConf.currentPage + pageConf.itemPerPage",getList);

}]);
app.factory('pageService',['$http',function($http){
    var service = {};
    service.list = function(postData){
        alert(123);
        return $http.post('page.php',postData);
    }

    return {
        list:function(postData){
            return list(postData);
        }
    }
}]);