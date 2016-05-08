<?hh

namespace Model;




class AngularApp {
	
	/**
	 * Map of <name,version> module dependencies
	 */
	protected Map<string,string> $modules;

	protected Set<string> $configBlocks;

	protected Set<string> $configDependencies;

	protected Set<string> $runBlocks;

	protected Set<string> $runDependencies;

	public function __construct()
	{
		$this->modules = new Map<string,string>();
		$this->configBlocks = new Set<string>();
		$this->configDependencies = new Set<string>();
		$this->runBlocks = new Set<string>();
		$this->runDependencies = new Set<string>();
	}

	public function modules() : Map<string,string>
	{
		return $this->modules;
	}

	public function configBlocks() : Set<string>
	{
		return $this->configBlocks;
	}

	public function runBlocks() : Set<string>
	{
		return $this->runBlocks;
	}
}