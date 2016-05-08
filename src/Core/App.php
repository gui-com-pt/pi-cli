<?hh

namespace Core;

use Model\InstallerModel,
	Core\CliResponse;



class App {
	
	public function __construct(protected $argv)
	{
		define('VERBOSE', in_array('--v', $argv) || in_array('-v', $argv) || in_array('-verbose', $argv));
	}


	public function run()
	{
		switch ($this->argv[1]) {
			case 'install':
				Tool::talk("Installing new application".PHP_EOL.PHP_EOL);
				$name = Tool::ask("Application name: ");
				$r = Tool::ask("Self hosted application? (y/n): ");
				$selfHosted = $r === 'y' || $r === true;
				$hostname = Tool::ask("Hostname (localhost): ");
				if(empty($hostname)) {
					$hostname = 'localhost';
				}
				$port = Tool::ask("Port (8080): ");
				if(!empty($port)) {
					try {
					$port = intval($port);
					}
					catch(\Exception $ex) {
						self::end(new CliResponse("Enter a valid integer port."));
					}	
				} else {
					$port = 8080;
				}
				
				$theme = Tool::ask("Theme (bootstrap): ");
				if(empty($theme)) {
					$theme = 'bootstrap';
				}
				$license = Tool::ask("License (MIT): ");
				if(empty($license)) {
					$license = 'MIT';
				}
				$installer = new Installer();

				$res = $installer->install(new InstallerModel($name, $hostname, $port, $selfHosted, $theme, $license));
				self::end($res);
				break;
			
			default:
				self::end(new CliResponse('The command is unknow'));
		}
		
	}

	public static function end(?CliResponse $model = null)
	{
		if($model == null) {
			echo 'End';
			
		}
		exit;
	}
}