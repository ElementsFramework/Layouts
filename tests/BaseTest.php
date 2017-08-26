<?php

namespace Tests;

use Illuminate\Filesystem\ClassFinder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\TestCase;

abstract class BaseTest extends TestCase
{

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';
        $app->register('ElementsFramework\Layout\LayoutServiceProvider');
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        config(require __DIR__.'/../src/Configuration/layout.php');

        return $app;
    }

    /**
     * Setup DB before each test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('database.default','sqlite');
        $this->app['config']->set('database.connections.sqlite.database', ':memory:');

        $this->migrate('up');
    }

    /**
     * run package database migrations
     *
     * @return void
     */
    public function migrate($action)
    {
        $fileSystem = new Filesystem();
        $classFinder = new ClassFinder();

        foreach($fileSystem->files(__DIR__ . "/../src/Migration") as $file)
        {
            $fileSystem->requireOnce($file);
            $migrationClass = $classFinder->findClass($file);

            (new $migrationClass)->$action();
        }
    }

    /**
     * Tear down DB after each test.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->migrate('down');
        parent::tearDown();
    }
}