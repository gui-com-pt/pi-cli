<?hh

namespace Core;




class Tool {
	
	static function talk(string $message)
	{
		echo $message.PHP_EOL;
	}

	static function ask(string $message)
	{
		return readline($message);
	}

	static function exec(string $command)
	{
		return shell_exec($command);
	}
}