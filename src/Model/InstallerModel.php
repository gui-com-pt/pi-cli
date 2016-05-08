<?hh

namespace Model;




class InstallerModel {
	
	protected string $bowerDesc;
	
	public function __construct(
		protected string $appName,
		protected string $host,
		protected int $port,
		protected bool $selfHosted = true,
		protected string $theme = 'bootstrap',
		protected string $license = 'MIT'

	)
	{
		$this->bowerDesc = "Bower package for $appName";
	}

	public function selfHosted() : bool
	{
		return $this->selfHosted;
	}

	public function appName() : string
	{
		return $this->appName;
	}

	public function host() : string
	{
		return $this->host;
	}

	public function port() : int
	{
		return $this->port;
	}

	public function bowerDesc() : string
	{
		return $this->bowerDesc;
	}

	public function theme() : string
	{
		return $this->theme;
	}

	public function license() : string
	{
		return $this->license;
	}
}