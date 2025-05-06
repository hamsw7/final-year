<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseMigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that Bagisto core migrations run successfully.
     *
     * @return void
     */
    public function test_bagisto_core_migrations()
    {
        // Run all migrations
        $this->artisan('migrate', ['--database' => 'testing'])
             ->assertExitCode(0);

        // Check Bagisto core tables
        $this->assertTrue(\Schema::hasTable('products'), 'Products table is missing');
        $this->assertTrue(\Schema::hasTable('orders'), 'Orders table is missing');
        $this->assertTrue(\Schema::hasTable('customers'), 'Customers table is missing');
        $this->assertTrue(\Schema::hasTable('carts'), 'Carts table is missing');
        $this->assertTrue(\Schema::hasTable('categories'), 'Categories table is missing');
    }

    /**
     * Test migration rollback.
     *
     * @return void
     */
    public function test_migration_rollback()
    {
        // Run migrations
        $this->artisan('migrate', ['--database' => 'testing'])
             ->assertExitCode(0);

        // Verify a table exists
        $this->assertTrue(\Schema::hasTable('products'), 'Products table is missing');

        // Roll back migrations
        $this->artisan('migrate:rollback', ['--database' => 'testing'])
             ->assertExitCode(0);

        // Verify the table is gone
        $this->assertFalse(\Schema::hasTable('products'), 'Products table still exists after rollback');
    }
}
