/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var app = angular.module("myApp", ["ngRoute"]);
console.log("Starting app");
//route config
app.config(function($routeProvider) {
  $routeProvider
  .when("/", {  
      templateUrl: "home.htm"
  })
  .when("/offer/list", {  
      templateUrl: "offer_list.htm",
      controller: "offerListController"  
  })  
  .when("/offer/add", {  
      templateUrl: "offer_add.htm",
      controller: "offerAddController"  
  })
  .when("/offer/list/:id", {  
      templateUrl: "offer_content.htm",
      controller: "offerContentController"  
  })
});

//route controllers
//LIST
app.controller("offerListController", function($scope, $http){
    console.log("list controller");
    console.log("Starting app");
    $http.get("http://localhost//RestWSv1.0/offer/list/")
    .then(function mySuccess(response){
        $scope.offerList = response.data;
        
        console.log("Sukckes: " + $scope.offerList);  
    }, function myError(response) {//error handling
        $scope.status = response.status;
        $scope.statusText = response.statusText;
        console.log($scope.status);
        console.log($scope.statusText);
        console.log(response.data);
    });
    $scope.isPrice = function(x){
        if(x>0){
            return true;
        }else{
            return false;
        }
    }
});

//CONTENT
app.controller("offerContentController", function($scope, $http, $routeParams, $location,){
    console.log("content controller");
    //GET
    $http.get("http://localhost//RestWSv1.0/offer/list/" + $routeParams.id)
    .then(function mySuccess(response){
        
        $scope.offer = response.data;        
        if($scope.offer.image_url=="NULL") $scope.offer.image_url=null;
        $scope.isPrice = function(x){
        if(x>0){
            return true;
        }else{
            return false;
        }
    }
        console.log("Response: " + $scope.offer["title"]);
    }, function myError(response) {//error handling
        $scope.status = response.status;
        $scope.statusText = response.statusText;
        console.log($scope.status + ': ' + $scope.statusText);
    });
    //DELETE
    $scope.deleteOffer = function(){
        if(confirm("Czy na pewno usunąć?")){//confirmation alert
            $http.delete("http://localhost//RestWSv1.0/offer/list/" + $routeParams.id)
            .then(function mySuccess(response){
            alert("Usunięto ofertę!");
            console.log("Deleted id: "+$routeParams.id);
            $location.path("offer/list/");        
            }, function myError(response) {//error handling
                console.log("DelErr");
            });
        }
    };
});
//ADD
app.controller("offerAddController", function($scope, $http, $location){
    console.log("add controller");
    $scope.form = [];
    $scope.form.title = '';
    $scope.form.content = '';
    $scope.form.price = null;
    $scope.form.image_url = null;
    
    $scope.sendForm = function(){
        console.log("send form");
        var data = {
                "title" : $scope.form.title,
                "content" : $scope.form.content,
                "price" : $scope.form.price,
                "image_url" : $scope.form.image_url
        };
        data = JSON.stringify(data);
        console.log(data);
        $http.post("http://localhost//RestWSv1.0/offer/add/", data)
            .then(function mySuccess(response){
                var data = response.data;
                console.log("succPOST "+data["id"]);
                $location.path("offer/list/"+response.data["id"]);
            }, function myError(response){
                console.log("postERR");
                $scope.ResponseDetails = "Data: " + response;
            });
    }    
});