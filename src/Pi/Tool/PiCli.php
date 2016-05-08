<?hh

namespace Pi\Tool;

use Ken\Cli;


class PiCli extends Cli {
	
	public function __construct()
	{
		parent::__construct();
		$this->binPaths[] = 'bin/pi';
	}
	/**
   * Initialize a new Ken project creating ken_config.php
   */
  	protected function initProject(string $configFile = "ken_config.php", $namespace = "Ken\Runtime") : void
  	{
    	if (file_exists($configFile)) {
        	fwrite(STDERR, "Project already has a ken_config.php\n");
	        return false;
	    }

	    $config = <<<'EOF'
<?hh

namespace Ken\Runtime;

task('default', array('update', 'serve'));

desc('Update all dependencies');
task('update', function() {
	println("Updating dependencies");
});

desc('Serve a server on a specific --port');
task('serve', function() {
	println("Updating dependencies");
});
EOF;

	    @file_put_contents($configFile, $config);

	    printf("Initialized Pi project at \"%s\"\n", getcwd());
	    return true;

	}
}