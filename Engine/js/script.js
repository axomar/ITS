var app = angular.module('shanidkvApp', []);

    app.controller('MainCtrl', function($scope,$http) {

    $scope.choices = [
        {id: 'choice1',type : 'text',value:'Texto'},
        {id: 'choice2',type : 'textarea',value:'Mucho texto'},
        {id: 'choice3',type : 'checkbox',value:false}
    ];

    $scope.addNewChoice = function(myType,nameRadio) {
        var newItemNo = $scope.choices.length+1;
        var value = '';
        var id ='choice'+newItemNo;
        if (myType == 'radio'){
            var name = nameRadio;
            value = false;
        }
        if(myType == "checkbox"){
            value = false;
        }
        $scope.choices.push({name:name,id:id,type:myType,value:value});
    };
        
    $scope.removeChoice = function() {
        var lastItem = $scope.choices.length-1;
        $scope.choices.splice(lastItem);
    };

    $scope.setChoice = function(choice) {
        angular.forEach($scope.choices, function(p) {
            if(p.name==choice.name && p.type=='radio'){
                p.value = false; //set them all to false
            }
        });
        if(choice.type == 'radio'){
            choice.value = true; //set the clicked one to true
        }
    };
    $scope.test = function() {

         // Simple POST request example (passing data) :
         $http.post('/angularAddForm/test.php', {result:$scope.choices}).
         success(function(data, status, headers, config) {
         // this callback will be called asynchronously
         // when the response is available
         $scope.choices = data;
         });
    };




});
