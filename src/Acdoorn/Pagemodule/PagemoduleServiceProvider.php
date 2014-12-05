<?php namespace Acdoorn\Pagemodule;

use Illuminate\Support\ServiceProvider;

class PagemoduleServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('acdoorn/pagemodule');
   		include __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->booting(function() {
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Pagemodule', 'Acdoorn\Packagetest\Facades\Pagemodule');
		});
		$this->app['Pagemodule'] = $this->app->share(function($app)
		{
			return new Pagemodule;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('pagemodule');
	}

}
