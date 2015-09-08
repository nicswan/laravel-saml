<?php namespace KnightSwarm\LaravelSaml;

use Illuminate\Support\ServiceProvider;

class LaravelSamlServiceProvider extends ServiceProvider {

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
  public function boot() {
    $this->package('knight-swarm/laravel-saml');
    include __DIR__ . '/../../routes.php';
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register() {

    app()->bind('Saml', function () {
      $samlboot = new Saml\SamlBoot(config('laravel-saml::saml.sp_name', 'default-sp'));

      return $samlboot->getSimpleSaml();
    });
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides() {
    return [];
  }

}
