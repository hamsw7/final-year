<?php
// tests/Unit/AgriCooperativeTest.php

use App\Models\AgriCooperative;

it('can create an agri-cooperative', function () {
    $cooperative = AgriCooperative::factory()->create();

    expect($cooperative)->toBeInstanceOf(AgriCooperative::class)
                        ->and($cooperative->name)->not->toBeEmpty();
});
