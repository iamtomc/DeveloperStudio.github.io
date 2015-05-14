var app = angular.module('app', []);

app.controller('ContactController', function($scope, $http) {
	$scope.test = 'hello';
	$scope.response = 'pending..';

	$scope.sendMail = function() {
		$http({
			method: 'POST',
			url: '/php/contact_us.php',
			data: $.param($scope.form),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data) {
			data = angular.fromJson(data);
			$scope.response = data.success;
		});
	};
});