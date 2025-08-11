<?php

use App\Livewire\Posts;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Posts::class)
        ->assertStatus(200);
});
