<?php

namespace A1tem\KnowledgeBase\Tests;

use A1tem\KnowledgeBase\KnowledgeBaseServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

/**
 * Class TestCase
 *
 * @package A1tem\KnowledgeBase\Tests
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations();
        $this->artisan('migrate', ['--database' => 'testbench'])->run();
        $this->withFactories(realpath(dirname(__DIR__).'/database/factories'));
    }

    /**
     * @param $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [KnowledgeBaseServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Sign in as a user
     *
     * @param User $user
     *
     * @return $this
     */
    protected function signIn(User $user = null)
    {
        $this->user = $user ?: create(User::class);
        Passport::actingAs($this->user);

        return $this;
    }
}
