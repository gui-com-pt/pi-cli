<?hh

namespace Core;

use Core\CliResponse,
	Core\Tool,
	Model\InstallerModel;




class Installer {
	
	protected Map<string,string> $templates;

	protected Map<string,string> $themeTemplates;

	public function __construct()
	{
		$this->templates = new Map(array(
			'gulpfile.js' => '/',
			'package.json' => '/',
			'bower.json' => '/',
			'app.mdl.js' => '/src/'));

		$this->themeTemplates = new Map(array(
			'index.html' => '/www',
			'home.tpl.html' => '/src/core'));
	}

	public function install(InstallerModel $model) : CliResponse
	{
		// Create project structure and add default templates
		if(!file_exists(WORK_DIR.'/www')) {
			mkdir(WORK_DIR.'/www');	
		}
		if(!file_exists(WORK_DIR.'/src')) {
			mkdir(WORK_DIR.'/src');
		}
		if(!file_exists(WORK_DIR.'/src/core')) {
			mkdir(WORK_DIR.'/src/core');
		}


		$this->templates->filterWithKey(
			($fileName, $path) ==> {
				$body = file_get_contents(TPL_DIR.'/'.$fileName);
				$body = str_replace('--REPLACE_BOWERDESC--', $model->bowerDesc(), $body);
				$body = str_replace('--REPLACE_APPNAME--', $model->appName(), $body);
				file_put_contents(WORK_DIR.$path.$fileName, $body);
			});

		// Theme
		$s = new Set(array('bootstrap'));
		$s->filter($theme ==> {
			$this->themeTemplates->filterWithKey(
				($fileName, $path) ==> {
					$body = file_get_contents(TPL_DIR.'/frontend/'.$theme.'/'.$fileName);
					file_put_contents(WORK_DIR.$path.'/'.$fileName, $body);
				});
			
		});
		switch ($model->theme()) {
			case 'pi':
				# code...
				break;
			
			default:
				// Bootstrap

				break;
		}

		// Install dependencies
		$dir = WORK_DIR;
		Tool::talk("Installing NodeJS dependencies");
		Tool::exec("cd $dir && npm install");}
		Tool::talk("Installing Bower dependencies");
		Tool::exec("cd $dir && bower install");
		Tool::talk("Building the application with Gulp");
		Tool::exec('gulp');

		return new CliResponse("The application was sucessefull installed");
	}
}