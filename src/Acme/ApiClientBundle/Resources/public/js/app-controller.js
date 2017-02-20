/**
 * The main controller for the app. The controller:
 * - retrieves and persists the model via Restangular
 * - exposes the model to the template and provides event handlers
 *
 * root_path & assets_path variables are set inside index.html.twig globally
 *
 * @type {angular.Module}
 */


angular.module('ApiClient.controllers', ['md.data.table','ngCookies','ngMaterial', 'ngAnimate', 'ngAria', 'ngMessages'])
    .controller('Login', ['AuthHandler', '$scope', '$rootScope', '$window', '$cookies', 'Restangular', 'Digest', '$modal', function (AuthHandler, $scope, $rootScope, $window, $cookies, Restangular, Digest, $modal) {
        
		$rootScope.hideit = true;
		// On Submit function
        $scope.getSalt = function () {
            var username = $scope.username;
            var password = $scope.password;
            // Get Salt
            Restangular
                .oneUrl('salts', root_path + 'public/salts/' + username).get()
                .then(function (response) {
                    var salt = response.salt;
                    // Encrypt password accordingly to generate secret
                    Digest.cipher(password, salt).then(function (secret) {
                        // Display salt and secret for this example
                        $scope.salt = salt;
                        $scope.secret = secret;

                       
                        // Store auth informations in cookies for page refresh
                        $cookies.put('username', $scope.username);
                        $cookies.put('secret', $scope.secret);

                        $window.location = '#/params';
                    }, function (err) {
                        console.log(err);
                    });
                });
        };
    }])
	
	.controller("paramCtrl", ['$timeout', '$scope', '$rootScope', '$http', function($timeout, $scope, $rootScope, $http){
	
	   $rootScope.hideit = false;

	   $scope.projects = null;
	  
	   $scope.users = null;
	  
	   $scope.loadParams = null;
	   
	   $scope.chbxEmail = false;
	   
	   $scope.chbxUrgent = false;
	   
	   $scope.chbxSms = false;

	   $scope.loadProjects = function() {

	    // Use timeout to simulate a 650ms request.
	    return $timeout(function() {

	      $scope.projects =  $scope.projects  || [
	        { id: 1, name: 'Ett - Adecco' },
	        { id: 2, name: 'Solaris' },
	        { id: 3, name: 'TicketAlert' },
	        { id: 4, name: 'Banque de France' },
	        { id: 5, name: 'Fidroit' }
	      ];

	    }, 650);
	  };
	  
	  $scope.loadUsers = function() {

	    // Use timeout to simulate a 650ms request.
	    return $timeout(function() {

	      $scope.users =  $scope.users  || [
	        { id: 1, name: 'Quentin JOIGNAUD' },
	        { id: 2, name: 'Camille CHARTON' },
	        { id: 3, name: 'Maxence LAURENT' },
	        { id: 4, name: 'Pierre Darmagnac' }
	      ];

	    }, 650);
	  };
	  

	    $scope.priorities =  $scope.priorities  || [
	        { id: 1, name: 'Aucune' },
	        { id: 2, name: 'Basse' },
	        { id: 3, name: 'Normale' },
	        { id: 4, name: 'Haute' },
			{ id: 5, name: 'Urgente' },
			{ id: 6, name: 'Immédiate' }
	    ];


	  
		$scope.categories = [
	        { id: 10, name: 'Design' },
	        { id: 20, name: 'Fonctionnalité' },
	        { id: 30, name: 'Bug' }
	      ];

	  
	   

	    $scope.severities = [
			{ id: 10, name: 'Fonctionnalité' },{ id: 20, name: 'Simple' },
			{ id: 30, name: 'Texte' },
			{ id: 40, name: 'Cosmétique' },
			{ id: 50, name: 'Mineur' },
			{ id: 60, name: 'Majeur' },
			{ id: 70, name: 'Critique' },
			{ id: 80, name: 'Bloquant' }
		];



	    $scope.statuses =  $scope.statuses  || [
			{id: 10, name: 'Nouveau'},
			{id: 20, name: 'Commentaire'},
			{id: 30, name: 'Confirmé'},
			{id: 40, name: 'Affecté'},
			{id: 50, name: 'Recette'},
			{id: 60, name: 'Analyse'},
			{id: 70, name: 'Développement'},
			{id: 80, name: 'Résolu'}
	    ];

	  
	  $scope.unchecked = function () {
	   	$scope.chbxUrgent = false;
	  };

	  
	  $scope.resetForm = function() {
		$scope.uncheckedChbx();
	    $scope.formParam.$setPristine();
	    $scope.formParam.$setUntouched();
		$scope.project = {};
		$scope.user = [];
		$scope.priority = [];
		$scope.category = [];
		$scope.severity = [];
		$scope.status = [];
		$scope.save = false;

	  };

	  
	  $scope.uncheckedChbx = function () {
		$scope.chbxEmail = false;
		$scope.chbxUrgent = false;
		$scope.chbxSms = false;
	  };
	   
	  $scope.save = function () {
	    var param = [];
		for (var i = 0; i < $scope.user.length; i++) {

			param[i] = {"project_id" : angular.toJson($scope.project),  " user_id: " : angular.toJson($scope.user[i]),  "chbxEmail" : $scope.chbxEmail, "chbxUrgent" : $scope.chbxUrgent,"chbxSms" : $scope.chbxSms, "priority_id" : angular.toJson($scope.priority), "category_id" : angular.toJson($scope.category), "severity_id" : angular.toJson($scope.severity), "status_id" : angular.toJson($scope.status) };
			console.log(param[i]);
		}
		
	  };
	   
	  
	  $scope.params = [
		  {"id" : 47, "project_id" : 2, "name" : "Quentin JOIGNAUD", "chbxEmail" : true, "chbxUrgent" : true, "chbxSms" : true, "priorities" : [{ id: 1}, { id: 2}], "categories" : [{ id: 10}], "severities" : [{ id: 10 },{ id: 20 }], "statuses" : [{id: 10 },{id: 20 },{id: 30 }]  },
		  {"id" : 164, "project_id" : 2, "name" : "Camille CHARTON", "chbxEmail" : true, "chbxUrgent" : false, "chbxSms" : true, "priorities" : [{ id: 3 },{ id: 4 }], "categories" : [{ id: 10 },{ id: 20 }], "severities" : [{ id: 30 },{ id: 40 },{ id: 50 }], "statuses" : [{id: 40 },{id: 50 },{id: 60 }]  },
		  {"id" : 377, "project_id" : 4, "name" : "Maxence LAURENT", "chbxEmail" : false, "chbxUrgent" : false, "chbxSms" : true, "priorities" : [{ id: 5 }, { id: 6 }], "categories" : [{ id: 10 },{ id: 20 },{ id: 30 }], "severities" : [{ id: 60 },{ id: 70 },{ id: 80 }], "statuses" : [{id: 70 },{id: 80 }]  }  
	  ];

	   $scope.loading = false;
  $http.get('stats.json')
    .success(function (data) {
      // do stuff with data
    })
    .catch(function (err) {
      // handle err
    })
    .finally(function () {
      $scope.loading = true;
    });
	  
	  /*
	  $scope.click = false;
	  $scope.searchButtonText = "Search";
	    $scope.test = "false";

	    $scope.search = function () {
			$scope.click = true;
	        $scope.test = "true";
	        $scope.searchButtonText = "Searching";
	        // Do your searching here
	        
	        $timeout(function(){
	            $scope.searchButtonText = "Search";
				$scope.click = false;
	        }, 2000);
	    }
		*/

  

	}])
	
	.controller("accountCtrl", function($scope){

	   $scope.account = {};
	   
	   $scope.account.login = '';
	   $scope.account.password = '';
	   $scope.account.email = '';
	   $scope.account.phoneNumber = '';
	   
	   
	   $scope.checkLog = function() {
		alert('checkLog');
	   };
	   

	   
	   $scope.resetForm = function(form_) {
		form_.login.$error = {};
		form_.password.$error = {};
		form_.email.$error = {};
		form_.phoneNumber.$error = {};
		form_.$setPristine();
		form_.$setValidity();
		form_.$setUntouched();
	  };

	})

	.controller("adminCtrl", function($scope){
	  'use strict';

	   $scope.account = {};
	   
	   $scope.account.login = 'admin';
	   $scope.account.password = 'admin';

	   
	   
	   $scope.checkLog = function() {
		alert('checkLog');
	   };
	   

	   
	   $scope.resetForm = function(form_) {
		form_.login.$error = {};
		form_.password.$error = {};

	  };

	})	
	
	.controller('statCtrl', ['$http', '$mdEditDialog', '$q', '$timeout', '$scope', function ($http, $mdEditDialog, $q, $timeout, $scope) {
	  'use strict';

	  $scope.options = {
		rowSelection: true,
		multiSelect: true,
		autoSelect: true,
		decapitate: false,
		largeEditDialog: false,
		boundaryLinks: false,
		limitSelect: true,
		pageSelect: true
	  };

	  $scope.selected = [];
	  $scope.limitOptions = [5, 10, 15, {
		label: 'All',
		value: function () {
		  return $scope.stats ? $scope.stats.count : 0;
		}
	  }];

	  $scope.query = {
		order: 'name',
		limit: 5,
		page: 1
	  };

	  // for testing ngRepeat
	  $scope.columns = [{
		name: 'stat',
		orderBy: 'name',
	  }, {
		name: '	Email',
		numeric: true,
		orderBy: 'email'
	  }, {
		name: 'Sms',
		numeric: true,
		orderBy: 'sms',
	  }, {
		name: 'Comments',
		orderBy: 'comment'
	  }];

	  $http.get('stats.json').then(function (stats) {
		$scope.stats = stats.data;

		// $scope.selected.push($scope.stats.data[1]);

		// $scope.selected.push({
		//   name: 'Ice cream sandwich',
		//   type: 'Ice cream',
		//   calories: { value: 237.0 },
		//   fat: { value: 9.0 },
		//   carbs: { value: 37.0 },
		//   protein: { value: 4.3 },
		//   sodium: { value: 129.0 },
		//   calcium: { value: 8.0 },
		//   iron: { value: 1.0 }
		// });

		// $scope.selected.push({
		//   name: 'Eclair',
		//   type: 'Pastry',
		//   calories: { value:  262.0 },
		//   fat: { value: 16.0 },
		//   carbs: { value: 24.0 },
		//   protein: { value:  6.0 },
		//   sodium: { value: 337.0 },
		//   calcium: { value:  6.0 },
		//   iron: { value: 7.0 }
		// });

		// $scope.promise = $timeout(function () {
		//   $scope.stats = stats.data;
		// }, 1000);
	  });

	  $scope.editComment = function (event, stat) {
		event.stopPropagation();

		var dialog = {
		  // messages: {
		  //   test: 'I don\'t like tests!'
		  // },
		  modelValue: stat.comment,
		  placeholder: 'Add a comment',
		  save: function (input) {
			stat.comment = input.$modelValue;
		  },
		  targetEvent: event,
		  title: 'Add a comment',
		  validators: {
			'md-maxlength': 30
		  }
		};

		var promise = $scope.options.largeEditDialog ? $mdEditDialog.large(dialog) : $mdEditDialog.small(dialog);

		promise.then(function (ctrl) {
		  var input = ctrl.getInput();

		  input.$viewChangeListeners.push(function () {
			input.$setValidity('test', input.$modelValue !== 'test');
		  });
		});
	  };

	  $scope.toggleLimitOptions = function () {
		$scope.limitOptions = $scope.limitOptions ? undefined : [5, 10, 15];
	  };

	  $scope.getTypes = function () {
		return ['Candy', 'Ice cream', 'Other', 'Pastry'];
	  };

	  $scope.onPaginate = function(page, limit) {
		console.log('Scope Page: ' + $scope.query.page + ' Scope Limit: ' + $scope.query.limit);
		console.log('Page: ' + page + ' Limit: ' + limit);

		$scope.promise = $timeout(function () {

		}, 2000);
	  };

	  $scope.deselect = function (item) {
		console.log(item.name, 'was deselected');
	  };

	  $scope.log = function (item) {
		console.log(item.name, 'was selected');
	  };

	  $scope.loadStuff = function () {
		$scope.promise = $timeout(function () {

		}, 2000);
	  };

	  $scope.onReorder = function(order) {

		console.log('Scope Order: ' + $scope.query.order);
		console.log('Order: ' + order);

		$scope.promise = $timeout(function () {

		}, 2000);
	  };

	}]);
	  