<?hh

namespace Core;




class CliResponse  {
	
	public function __construct(
		protected string $message,
		protected ?string $code = null
	)	
	{

	}

	public function message() : string
	{
		return $this->message;
	}

	public function code() : string
	{
		return $this->code ?: 'Error';
	}
}