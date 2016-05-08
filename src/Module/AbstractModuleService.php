<?hh

namespace Module;

use Model\AngularApp;




abstract class AbstractModuleService {
	
	public function __construct(
		proteced AngularApp $app
	)
	{

	}
	abstract function name() : string;
}