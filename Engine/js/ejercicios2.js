var CARPETA = "../Engine";

var app = angular.module('lordAngeloApp', []);

    app.controller('MainCtrl', function($scope,$http,$compile) {

	  $scope.valor="0";
	  $scope.numFeedback="0";
	  $scope.exercise="";
	  $scope.focus="0";
      $scope.logging = [];
	  $scope.previousInput=0;
	  $scope.help="off";
	  
      $scope.setVariables = function(exercise, num_exe) {
        // Simple POST request example (passing data) :
		$scope.exercise = exercise;
        $http.post(CARPETA+'/Variables.php?exercise=' + $scope.exercise  + '&num_exe=' + num_exe, {result:$scope.questions}).
            success(function(data, status, headers, config) {
                // this callback will be called asynchronously
                // when the response is available
                $scope.questions = data;
            });
      };

	  // Send logged data to be saved in the DB
      $scope.saveLog = function(id,course_id,num_eje,cont_eje) {
        // Simple POST request example (passing data) :
		
		$scope.logData('x');
        $http.post(CARPETA+'/log/Log_Files.php?user_id=' + id + '&course_id=' + course_id + '&cidReq=' + cidReq + '&exercise_id=' + num_eje + '&cont_eje=' + cont_eje, {results:$scope.logging}).
            success(function(data, status, headers, config) {
                // this callback will be called asynchronously
                // when the response is available
                //$scope.questions = data;
				//$scope.previousInput = 10;
            });
      };
	  
      $scope.getSolutions = function(index) {
        // Simple POST request example (passing data) :
        $http.post(CARPETA + '/solEval.php?exercise=' + $scope.exercise, {result:$scope.choices, result2:$scope.questions}).
            success(function(data, status, headers, config) {
                // this callback will be called asynchronously
                // when the response is available
			$scope.choices = data;
			$scope.valor="0";
            });
		
	//	$scope.logData(index);
		
      };
	  
	  $scope.Next = function() {
  		var num=Number ($scope.valor);
		var max=Number($scope.numFeedback);
		if(num < max){
			num = num + 1;
			$scope.valor = String(num);
        } 
	  };

	  $scope.Previous = function() {
  		var num=Number($scope.valor);
		if(num > 0){
			num = num - 1;
			$scope.valor = String(num);
        }
      };

	  $scope.setNumFeedback = function(index) {
		if($scope.numFeedback < index)
			$scope.numFeedback = index;
      };

	  $scope.setFocus = function(index) {
  		$scope.focus = index;
		$scope.getSolutions();
		$scope.logData(index);
      };
	  
	  // Generate the log data after a focus change
	  $scope.logData = function(index) {
  		var currentDate = new Date();
		var day     = currentDate.getDate();
		var month   = currentDate.getMonth() + 1;
		var year    = currentDate.getFullYear();
		var hours   = currentDate.getHours();
		var minutes = currentDate.getMinutes();
		var seconds = currentDate.getSeconds();
	
		var fecha = year + '-' + month + '-' + day;
		var hora  = hours + ':' + minutes + ':' + seconds;
		
		
		if(index=='x')							// Next link clicked
		{
			$scope.logging.push({
					date  : fecha,
					time  : hora,
					input : $scope.previousInput,
					data  : "Exit",
					result: $scope.choices
				});
		}
		else if(index=='?')						// Help button clicked
		{
			$scope.focus = '0';
		//	$scope.getSolutions();

			if ($scope.help == "off")
				$scope.help = "on";
			else
				$scope.help = "off";
			$scope.logging.push({
					date  : fecha,
					time  : hora,
					input : $scope.previousInput,
					data  : "Help " + $scope.help,
					result: $scope.choices
				});
		}
		else									// Environment feedback
		{
			if($scope.choices[$scope.previousInput].value != null)
			{	
			//	 $scope.logging[0].result = 'test';
		 
			  $scope.logging.push({
				date  : fecha,
				time  : hora,
				input : $scope.previousInput,
				data  : $scope.choices[$scope.previousInput].value,
				//result: $scope.choices
				result: $scope.choices
			  });
			}
			$scope.previousInput = index;
		}
	  };
	
	
    }); //app controler

//Despliega botón de ayuda
$(document).ready(function(){
    $("#feedback").click(function(){
        $("#help").slideToggle("slow");
    }
	);	
});

