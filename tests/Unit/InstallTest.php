<?php

namespace Aboleon\Framework\Tests\Unit;

use Illuminate\Support\Facades\{
    Artisan,
    File
};
use Aboleon\Framework\Tests\TestCase;

class InstallTest extends TestCase
{
    /** @test */
    function the_install_command_copies_the_configuration_file()
    {
        // make sure we're starting from a clean state
        if (File::exists(config_path('aboleon_framework.php'))) {
            unlink(config_path('aboleon_framework.php'));
        }

        $this->assertFalse(File::exists(config_path('aboleon_framework.php')));
        Artisan::call('aboleon:framework install');

        $this->assertTrue(File::exists(config_path('aboleon_framework.php')));
    }

}