angular
	.module('templates', []);
	
(function(){
	angular
		.module('app', ['ui.router', 'templates']);

	angular
		.module('app')
		.config(['$stateProvider',
			function($stateProvider) {
				$stateProvider
					.state('home', {
						url: '/',
						templateUrl: 'core/home.tpl.html'
					});
			}])
		.run(['$rootScope',
			function($rootScope) {

				
			}]);
})();