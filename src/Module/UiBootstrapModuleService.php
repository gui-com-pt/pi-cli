<?hh

namespace Module;




class UiBootstrapModuleService extends AbstractModuleService {
	
	public function name() : string
	{
		return 'ui.bootstrap';
	}
	
	public function config()
	{
		
	}

	public function run()
	{
		if(!$this->app->runDependencies()->contains('$rootScope')) {
			$this->app->runDependencies()->add('$rootScope');
		}

		$this->app->runBlocks()->add(<<<EOF
			if(!_.isString($rootScope.app.theme)) {
				$rootScope.app.theme = "bootstrap";
			}

EOF;
	);
	}
}