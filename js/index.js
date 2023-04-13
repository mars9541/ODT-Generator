var app = angular.module('MyApp', []);
app.controller('MainCtrl', function ($scope, $http) {

	$scope.curr = {
		"question": "", "answer": ""
	};

	$scope.subRow = [];

	var subQuestion = { "sub_question": "", "sub_answer": "" };
	var childQuestion = { "child_question": "", "child_answer": "", "type": "text", "name": "" };
	$scope.answerType = ["text", "select", "radio", "value"];

	$scope.index = 1;

	$scope.jsonContent = jsonData;

	$scope.addRow = function () {
		var json = { 'question': '' };
		$scope.jsonContent.push(json);
	};

	$scope.save = function () {
		// var params = JSON.stringify($scope.jsonContent);
		$http.post("../form2json/question.php", { data: $scope.jsonContent })
			.then(function (response) {

			});
	};

	$scope.DeleteQuestion = function (index) {
		$scope.jsonContent.splice(index, 1);
	};

	$scope.DeleteSubQuestion = function (row, index) {
		row.subRow.splice(index, 1);
	};

	$scope.changeJson = function () {

	}

	$scope.addSubQuestion = function (index) {
		angular.forEach($scope.jsonContent, function (value, key) {
			if (key == index) {
				if (!Array.isArray(value.subRow)) {
					value.subRow = [];
				}
				var subkey = (value.subRow.length);
				value.subRow[subkey] = Object.assign({}, subQuestion);
			}
		});
	}

	$scope.addChildSubQuestion = function (parentIndex, index) {
		angular.forEach($scope.jsonContent, function (parentValue, key) {
			if (key == parentIndex) {
				angular.forEach(parentValue.subRow, function (subValue, subKey) {
					if (subKey == index) {
						if (!Array.isArray(subValue.childRow)) {
							subValue.childRow = [];
						}
						var childKey = (subValue.childRow.length);
						subValue.childRow[childKey] = Object.assign({}, childQuestion);
					}
				});
			}
		});
	}

	$scope.deleteChildSubQuestion = function (parentIndex, subRowKey, index) {
		angular.forEach($scope.jsonContent, function (parentValue, key) {
			if (key == parentIndex) {
				angular.forEach(parentValue.subRow, function (subValue, subKey) {
					if (subKey == subRowKey) {
						subValue.childRow.splice(index, 1);
					}
				});
			}
		});
	}
});