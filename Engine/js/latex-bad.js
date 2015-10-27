var CARPETA = "/ProyOMA" ;

var app = angular.module('lordAngeloApp', []);

    app.controller('MainCtrl', function($scope,$http, $compile) {



    $scope.hola = function() {
        $scope.myid=0;
        $scope.varID=0;
        $scope.choices = [  ];
        $scope.questions = [  ];
        var mystring = "ng-class=\"choices[myid].resp\" " +
                       "ng-blur=\"getSolutions()\" " +
					   "ng-click=\"setFocus('myid')\" " +
                       "id=\"{{choices[myid].id}}\" " +
                       "ng-model=\"choices[myid].value\" " +
                       "name=\"{{choices[myid].name}}\" " +
                       "ng-checked=\"choices[myid].value\" " +
                       "ng-value=\"choices[myid].value\" "+
                       "ng-init=\"choices[myid].value=null\" ";

        var mystringQuest = "ng-class=\"questions[varID].resp\" " +
                       "id=\"{{questions[varID].id}}\" " +
                       "ng-model=\"questions[varID].value\" " +
                       "name=\"{{questions[varID].name}}\" " +
                       "ng-value=\"questions[varID].value\" "+
                       "ng-init=\"questions[varID].value=varID\" disabled ";
        var di = document.getElementById("hola");
        var res = $scope.holaa.replace(/InputText/g, function myFunction(x){
            var mystringID = mystring.replace(/myid/g, function myFunction(x){return $scope.myid});
            $scope.choices.push({name:"name"+$scope.myid,id:$scope.myid,type:'text',value:''});
            $scope.myid++;
            return "\\html'&lt;input type=tetxt "+mystringID+" size=1>'"
        });
        var res = res.replace(/InputArea/g, function myFunction(x){
            var mystringID = mystring.replace(/myid/g, function myFunction(x){return $scope.myid});
            $scope.choices.push({name:"name"+$scope.myid,id:$scope.myid,type:'area',value:''});
            $scope.myid++;
            return "\\html'&lt;textarea type=tetxt "+mystringID+" size=1>'"
        });
        var res = res.replace(/InputCheck/g, function myFunction(x){
            var mystringID = mystring.replace(/myid/g, function myFunction(x){return $scope.myid});
            $scope.choices.push({name:"name"+$scope.myid,id:$scope.myid,type:'checkbox',value:''});
            $scope.myid++;
            return "\\html'&lt;input type=checkbox "+mystringID+" size=1>'"
        });
        var res = res.replace(/InputRadio/g, function myFunction(x){
            var mystringID = mystring.replace(/myid/g, function myFunction(x){return $scope.myid});
            $scope.choices.push({name:"name"+$scope.myid,id:$scope.myid,type:'radio',value:''});
            $scope.myid++;
            return "\\html'&lt;input type=radio "+mystringID+" size=1>'"
        });
        var res = res.replace(/Variable/g, function myFunction(x){
            var mystringID = mystringQuest.replace(/varID/g, function myFunction(x){return $scope.varID});
            $scope.questions.push({name:"name"+$scope.varID,id:$scope.varID,type:'tetxt',value:'?'});
            $scope.varID++;
            return "\\html'&lt;input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  "+mystringID+"  size=1>'"
        });



        $scope.aguardar=res;
        di.innerHTML = '$$'+res+'$$';
        M.parseMath(di);
        $compile( document.getElementById('hola') )($scope);

    };
    $scope.test = function() {
        // Simple POST request example (passing data) :
        $http.post(CARPETA+'/test.php', {result:$scope.choices}).
            success(function(data, status, headers, config) {
                // this callback will be called asynchronously
                // when the response is available
                $scope.choices = data;
            });
    };
    $scope.guardar = function() {
        // Simple POST request example (passing data) :
        $http.post(CARPETA+'/saveFile.php', {result:document.getElementById("hola").innerHTML.toString()     }).
            success(function(data, status, headers, config) {
                // this callback will be called asynchronously
                // when the response is available
                $scope.aguardar = data;
               // alert(document.getElementById("hola").innerHTML );
            });
    };
});
