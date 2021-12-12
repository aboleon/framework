<?php

namespace Aboleon\Framework;

use Aboleon\Framework\Components\{
    BootstrapCheckbox,
    BootstrapSingleCheckbox,
    BootstrapInput,
    BootstrapRadio,
    BootstrapSelect,
    BootstrapTextarea,
    BtnSave,
    DeleteLink,
    DeleteLinkActions,
    DeleteLinkModal,
    EditLink,
    Header,
    LanguageTabs,
    Layout,
    NavLink,
    NavOpeningLink,
    Pagination,
    ResponseMessages,
    ValidationErrors};
use Aboleon\Framework\Http\ResponseRenderers;
use Aboleon\Framework\Console\Install;
use Illuminate\Support\Facades\View;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->bind('aboleon_response_renderers', function ($app) {
            return new ResponseRenderers();
        });

    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'aboleon.framework');
        $this->loadTranslationsFrom(__DIR__ . '/Resources/lang', 'aboleon.framework');
        $this->loadViewComponentsAs('aboleon.framework', [
            BootstrapCheckbox::class,
            BootstrapSingleCheckbox::class,
            BootstrapInput::class,
            BootstrapRadio::class,
            BootstrapSelect::class,
            BootstrapTextarea::class,
            BtnSave::class,
            DeleteLink::class,
            DeleteLinkActions::class,
            DeleteLinkModal::class,
            EditLink::class,
            Header::class,
            LanguageTabs::class,
            Layout::class,
            NavLink::class,
            NavOpeningLink::class,
            Pagination::class,
            ResponseMessages::class,
        ]);

        View::share('locales', config('aboleon_framework.locales'));

        if ($this->app->runningInConsole()) {

            $this->publishConfig();
            $this->publishMigrations();
            $this->publishSeeders();
            $this->publishViews();
            $this->publishComponents();
            $this->publishAssets();
            $this->publishRoutes();

            $this->commands([
                Install::class,
            ]);
        }
    }

    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/aboleon_framework.php' => config_path('aboleon_framework.php'),
        ], 'aboleon-framework-config');
    }

    private function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/create_config_table.php.stub' => database_path('migrations/aboleon/framework/' . date('Y_m_d_his') . '_create_config_table.php'),
            __DIR__ . '/../database/migrations/alter_users_table.php.stub' => database_path('migrations/aboleon/framework/' . date('Y_m_d_his') . '_alter_names_users_table.php'),
        ], 'aboleon-framework-migrations');
    }

    private function publishSeeders()
    {
        $this->publishes([
            __DIR__ . '/../database/seeders/Seeder.php.stub' => database_path('seeders/Aboleon/Framework/Seeder.php'),
            __DIR__ . '/../database/seeders/ConfigurablesTableSeeder.php.stub' => database_path('seeders/Aboleon/Framework/ConfigurablesTableSeeder.php'),
            __DIR__ . '/../database/seeders/UsersTableSeeder.php.stub' => database_path('seeders/Aboleon/Framework/UsersTableSeeder.php'),
            __DIR__ . '/../database/seeders/TeamsSeeder.php.stub' => database_path('seeders/Aboleon/Framework/TeamsSeeder.php'),
        ], 'aboleon-framework-seeders');
    }

    private function publishRoutes(): void
    {
        $this->publishes([
            __DIR__ . '/../publishables/routes' => base_path('routes')
        ], 'aboleon-framework-routes');
    }

    private function publishViews(): void
    {
        $this->publishes([
            __DIR__ . '/../publishables/views' => resource_path('views'),
            __DIR__ . '/Resources/views/layouts' => resource_path('views/vendor/aboleon.framework/layouts')
        ], 'aboleon-framework-views');
    }

    private function publishComponents(): void
    {
        $this->publishes([
            __DIR__ . '/../publishables/components' => app_path('View/Components'),
        ], 'aboleon-framework-components');
    }

    private function publishAssets(): void
    {
        $this->publishes([
            __DIR__ . '/../publishables/assets' => public_path('aboleon/framework/'),
        ], 'aboleon-framework-assets');
    }
}