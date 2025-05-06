<?php
// tests/Feature/ResourceProviderTest.php

use App\Models\ResourceProvider;

it('shows resource provider dashboard', function () {
    $provider = ResourceProvider::factory()->create();

    actingAs($provider)
        ->get('/dashboard/resource-provider')
        ->assertStatus(200)
        ->assertSee('Welcome');
});
