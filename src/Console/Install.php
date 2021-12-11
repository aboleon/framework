<?php

namespace Aboleon\Framework\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aboleon:framework {argument}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Aboleon Framework';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        if (method_exists($this, $this->argument('argument'))) {
            $this->{$this->argument('argument')}();
        } else {
            $this->error("Aboleon Framework: unknown console command '" . $this->argument('argument') . "'");
        }
    }

    protected function install()
    {
        $this->newLine();
        $this->info('Installing Aboleon Framework...');

        $this->setDatabaseVariables();
        $this->installJetstream();
        $this->publishConfigFile();
        $this->publishMigrations();
        $this->publishSeeders();

        $this->publishViews();
        $this->publishComponents();
        $this->publishAssets();
        $this->publishRoutes();

        passthru('php artisan config:cache');

        $this->installComposerPackages();
        $this->removeIgnition();

        passthru('php artisan optimize');

        $this->newLine();
        $this->info('Installed Aboleon Framework');

    }


    private function installComposerPackages()
    {
        $this->newLine();
        $this->comment('Installing Debugbar package...');
        $this->comment('------------------------------------------');
        passthru('composer require barryvdh/laravel-debugbar --dev');

        $this->newLine();
        $this->comment('Installing Whoops package...');
        $this->comment('------------------------------------------');
        passthru('composer require filp/whoops --dev');
    }

    private function removeIgnition()
    {
        $this->newLine();
        $this->comment('Removing Ignition package...');
        $this->comment('------------------------------------------');
        passthru('composer remove facade/ignition --dev');
    }


    private function setDatabaseVariables()
    {
        $this->newLine();
        $this->comment('Database setup...');
        $this->comment('------------------------------------------');

        $db_name = $this->ask("Database name");
        $db_user = $this->ask("Database user");
        $db_password = $this->ask("Database password");

        $env_file = base_path('.env');
        $lines = file($env_file, FILE_IGNORE_NEW_LINES);
        $seek = array_filter($lines, function ($line) {
            return strstr($line, 'DB_DATABASE');
        });
        $lines[key($seek)] = 'DB_DATABASE=' . $db_name;

        $seek = array_filter($lines, function ($line) {
            return strstr($line, 'DB_USERNAME');
        });
        $lines[key($seek)] = 'DB_USERNAME=' . $db_user;

        $seek = array_filter($lines, function ($line) {
            return strstr($line, 'DB_PASSWORD');
        });
        $lines[key($seek)] = 'DB_PASSWORD=' . $db_password;

        file_put_contents($env_file, implode("\n", $lines));

        $this->clearCaches();
    }

    private function clearCaches(): void
    {
        $this->newLine();
        $this->comment('Updating caches...');
        $this->comment('------------------------------------------');
        $this->call('config:cache');
        $this->call('cache:clear');
        passthru('composer dump-autoload -o');
        passthru('php artisan optimize');
        //passthru('php artisan cache:clear');
    }

    private function installJetstream()
    {
        $this->newLine();
        $this->comment('Installing Laravel Jetstream...');
        $this->comment('------------------------------------------');
        passthru('php artisan jetstream:install livewire --teams');
        passthru('npm install');
        passthru('npm run dev');
        passthru('php artisan vendor:publish --provider=Laravel\Sanctum\SanctumServiceProvider');
        passthru('php artisan vendor:publish --tag=jetstream-views --force');
        passthru('php artisan migrate');
    }

    private function publishMigrations(): void
    {

        $params = [
            '--provider' => "Aboleon\Framework\ServiceProvider",
            '--tag' => "aboleon-framework-migrations"
        ];

        $this->newLine();
        $this->comment("\n" . 'Publishing migrations...');
        $this->comment('------------------------------------------');
        $this->call('vendor:publish', $params);
        $this->info('Migrations in database/migrations/aboleon/framework');

        $this->newLine();
        $this->comment('Creating tables...');
        $this->comment('------------------------------------------');
         passthru('php artisan migrate --path=database/migrations/aboleon/framework');
      //  $this->call('migrate', ['--path' => 'database/migrations/aboleon/framework']);
        $this->info('Tables created. Rollback package migrations by running php artisan:rollback');
    }

    private function publishSeeders(): void
    {
        $this->newLine();
        $this->comment('Publishing seeders...');
        $this->comment('------------------------------------------');
      //  passthru('php artisan vendor:publish --provider=Aboleon\Framework\ServiceProvider --tag=aboleon-framework-seeders');

        $this->call('vendor:publish', [
            '--provider' => "Aboleon\Framework\ServiceProvider",
            '--tag' => "aboleon-framework-seeders"
        ]);
        $this->info('Seeders copied in database/seeders/Aboleon/Framework');

        $this->setMainUser();

        $this->newLine();
        $this->comment('Seeding...');
        $this->comment('------------------------------------------');
        $this->call('db:seed', ['--class' => 'Database\Seeders\Aboleon\Framework\Seeder']);

        //$this->unsetUsersSeeder();

    }


    private function publishRoutes(): void
    {
        $this->newLine();
        $this->comment('Publishing route file...');
        $this->comment('------------------------------------------');

        passthru('php artisan vendor:publish --provider=Aboleon\Framework\ServiceProvider --tag=aboleon-framework-routes --force');

    }

    private function publishViews()
    {
        passthru('php artisan config:cache');

        $this->newLine();
        $this->comment('Publishing views...');
        $this->comment('------------------------------------------');


        if (file_exists(resource_path('views/welcome.blade.php'))) {
            $this->replaceInFile('/home', config('aboleon_framework.route') . '/dashboard', resource_path('views/welcome.blade.php'));
            $this->replaceInFile('Home', 'Dashboard', resource_path('views/welcome.blade.php'));
        }

        passthru('php artisan vendor:publish --provider=Aboleon\Framework\ServiceProvider --tag=aboleon-framework-views --force');

    }

    private function publishComponents()
    {
        $this->newLine();
        $this->comment('Publishing Components...');
        $this->comment('------------------------------------------');

        passthru('php artisan vendor:publish --provider=Aboleon\Framework\ServiceProvider --tag=aboleon-framework-components --force');

    }

    private function publishAssets()
    {
        $this->newLine();
        $this->comment('Publishing assets...');
        $this->comment('------------------------------------------');
        $params = [
            '--provider' => "Aboleon\Framework\ServiceProvider",
            '--tag' => "aboleon-framework-assets"
        ];

        $this->call('vendor:publish', $params);
    }

    private function publishConfigFile()
    {
        $this->newLine();
        $this->comment('Publishing configuration...');
        $this->comment('------------------------------------------');

        $app_name = $this->ask("What is the name of your app");
        $app_default_lg = $this->ask("What is the app default language locale (en, fr, de..) ? Default is en");

        $file = config_path('app.php');
        $lines = file($file, FILE_IGNORE_NEW_LINES);

        $seek = array_filter($lines, function ($line) {
            return strstr($line, "'name'");
        });
        $lines[key($seek)] = "    'name' => '" . addslashes($app_name) . "',";

        $seek = array_filter($lines, function ($line) {
            return strstr($line, "'locale'");
        });
        $lines[key($seek)] = "    'locale' => '" . $app_default_lg . "',";

        $seek = array_filter($lines, function ($line) {
            return strstr($line, "'fallback_locale'");
        });
        $lines[key($seek)] = "    'fallback_locale' => '" . $app_default_lg . "',";
        file_put_contents($file, implode("\n", $lines));

        $panel_prefix = $this->ask("What is the prefix for your back-office routes");

        file_put_contents(__DIR__ . '/../../config/aboleon_framework.php', "<?php
return [
    'route' => '" . $panel_prefix . "',
    'locales' => ['" . $app_default_lg . "'],
    'active_locales' => ['" . $app_default_lg . "']
];");

        $this->replaceInFile('/dashboard', '/' . $panel_prefix . '/dashboard', app_path('Providers/RouteServiceProvider.php'));


        $this->callPublishConfiguration();
    }

    private function setMainUser()
    {
        $this->newLine();
        $this->comment('Setting up the main user...');
        $this->comment('------------------------------------------');

        $name = $this->ask("Organization");
        $first_name = $this->ask("First name");
        $last_name = $this->ask("Last_name");
        $email = $this->ask("e-mail");
        $password = $this->secret("Please type your desired password");

        $file = database_path('seeders/aboleon/framework/UsersTableSeeder.php');
        $lines = file($file, FILE_IGNORE_NEW_LINES);

        $seek = array_filter($lines, function ($line) {
            return strstr($line, "'name'");
        });
        $lines[key($seek)] = "                    'name' => '" . $name . "',";

        $seek = array_filter($lines, function ($line) {
            return strstr($line, "'first_name'");
        });
        $lines[key($seek)] = "                    'first_name' => '" . $first_name . "',";

        $seek = array_filter($lines, function ($line) {
            return strstr($line, "'last_name'");
        });
        $lines[key($seek)] = "                    'last_name' => '" . $last_name . "',";

        $seek = array_filter($lines, function ($line) {
            return strstr($line, "'password'");
        });
        $lines[key($seek)] = "                    'password' => '" . bcrypt($password) . "',";

        $seek = array_filter($lines, function ($line) {
            return strstr($line, "'email'");
        });
        $lines[key($seek)] = "                    'email' => '" . $email . "',";

        file_put_contents($file, implode("\n", $lines));

    }

    private function configExists($fileName): bool
    {
        return File::exists(config_path($fileName));
    }

    private function shouldRemoveInstall(): bool
    {
        $this->alert('Are you sure to remove the Aboleon Framework ?');
        $this->comment('This will remove configuration files, migrations, database tables, application files and assets.');
        $this->comment('You can choose what to delete precisely, step by step, or remove it all at once.');
        return $this->confirm(
            'Proceed ?',
            false
        );
    }

    private function shouldRemoveInstallBySteps(): bool
    {
        return $this->confirm(
            'Do you want to remove it step by step ?',
            false
        );
    }

    private function callPublishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Aboleon\Framework\ServiceProvider",
            '--tag' => "aboleon-framework-config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = '';
        }

        $this->call('vendor:publish', $params);
    }


    /**
     * Replace a given string within a given file.
     *
     * @param string $search
     * @param string $replace
     * @param string $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }


    protected function remove()
    {
        if ($this->shouldRemoveInstall()) {
            $this->info('Removing Aboleon Framework...');

            if ($this->shouldRemoveInstallBySteps()) {

                if ($this->confirm(
                    'Remove config file ?',
                    false
                )) {
                    File::delete(config_path('aboleon_framework.php'));
                    $this->info(config_path('aboleon_framework.php') . ' was deleted');
                }

                if ($this->confirm(
                    'Remove database migration files ?',
                    false
                )) {
                    File::deleteDirectory(database_path('migrations/aboleon/framework'));
                    $this->info('migrations/aboleon/framework was deleted');
                    File::deleteDirectory(database_path('seeders/Aboleon/Framework'));
                    $this->info(database_path('seeders/Aboleon/Framework was deleted'));
                }

                if ($this->confirm(
                    'Remove database tables ?',
                    false
                )) {
                    Schema::dropIfExists('aboleon_framework_config');
                    $this->info('Table aboleon_framework_config was deleted.');
                }

            } else {

                File::delete(config_path('aboleon_framework.php'));
                File::deleteDirectory(database_path('migrations/aboleon/framework'));
                File::deleteDirectory(database_path('seeders/Aboleon/Framework'));
                Schema::dropIfExists('aboleon_framework_config');
            }

            $this->info('Aboleon Framework was removed.');
            $this->clearCaches();

        } else {
            $this->info('Aboleon Framework was not removed.');
        }
    }


}