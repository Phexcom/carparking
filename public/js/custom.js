var hostname = "http://localhost/assign/";

var app = angular.module("carParking", [
	'jcs-autoValidate',
	'angular-ladda'
	]);

app.run(function (defaultErrorMessageResolver) {
		defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
			errorMessages['invalidUsername'] = 'Username can only be in format of letter, numbers and underscore(_)';
			errorMessages['invalidMobile'] = 'invalid mobile number';
			errorMessages['invalidPassword'] = 'Password must consist of (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)';
			


			
		});
	});
// start login control
app.controller('LoginController', function($scope, $http) {

	$scope.loginForm = {};
	$scope.loginSubmmiting = false;
	$scope.onSubmit = function () {
		$scope.loginSubmitting = true;

		$http.post(hostname+'handlers/Login.php' , $scope.loginForm).
	success(function (data) {
				if(data == "valid"){
					$scope.submitting = false;
					$scope.submitted = true;
					$scope.has_error = false;
					setTimeout(function () {
			     	window.location = hostname+'parking';
			    	}, 3000);
					
				}else if(data == "invalid"){
					$scope.has_error = true;
					$scope.submitting = false;
					$scope.submitted = false;
					setTimeout(function () {
			     	window.location = hostname;
			    	}, 3000);
					
				}else if(data == "notactivated"){
					$scope.submitting = false;
					$scope.submitted = false;
					setTimeout(function () {
			     	window.location = hostname+'temp/created.php';
			    	}, 3000);
					
				}else{
					window.location = hostname;
				}
			});


	};
});
// end login control



// start register control
app.controller('RegisterController', function($scope, $http) {

	$scope.registerForm = {};
	$scope.registerSubmitting = false;

	$scope.onSubmit = function () {
		$scope.registerSubmitting = true;

	$http.post(hostname+'handlers/Register.php' , $scope.registerForm).
	success(function (data) {
				if(data == "signup"){
					$scope.submitting = false;
					$scope.submitted = true;
					$scope.has_error = false;
					setTimeout(function () {
			     	window.location = hostname;
			    	}, 3000);
					
				}else if(data == "invalid"){
					$scope.has_error = true;
					$scope.submitting = false;
					$scope.submitted = false;
					setTimeout(function () {
			     	window.location = hostname;
			    	}, 3000);
					
				}else{
					window.location = hostname;
				}
			});

	};
});
// end register control


//User Controller

app.controller('UserController', function($scope, $http) {
    $http.get("http://localhost/assign/handlers/Logged.php")
    .then(function (response) {$scope.names = response.data.records;});
});


//End User Controller


//Parking Contoller

app.controller('ParkController', function($scope, $http) {

	$scope.CarParking = {};
	$scope.parkSubmitting = false;

	$scope.onSubmit = function () {
		$scope.parkSubmitting = true;

	$http.post(hostname+'handlers/park.php' , $scope.CarParking).
	success(function (data) {
				if(data == "park"){
					$scope.submitting = false;
					$scope.submitted = true;
					$scope.has_error = false;
					setTimeout(function () {
			     	window.location = hostname;
			    	}, 3000);
					
				}else if(data == "invalid"){
					$scope.has_error = true;
					$scope.submitting = false;
					$scope.submitted = false;
					setTimeout(function () {
			     	window.location = hostname;
			    	}, 3000);
					
				}else{
					window.location = hostname;
				}
			});
	};
   
});


//End Parking Controller