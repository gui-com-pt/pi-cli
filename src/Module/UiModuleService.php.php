<?hh

namespace Module;




class UiModuleService extends AbstractModuleService {
	
	public function name() : string
	{
		return 'ui';
	}
	
	public function config()
	{
		if(!$this->app->configDependencies()->contains('$stateProvider')) {
			$this->app->configDependencies()->add('$stateProvider');
		}

	}

	public function run()
	{

	}
}