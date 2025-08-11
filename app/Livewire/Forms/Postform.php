<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Mary\Traits\Toast;

class Postform extends Form
{
    use Toast;
    #[Rule(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Rule(['required', 'string', 'max:1000'])]
    public string $body = '';
    


    // protected $rules = [
    //     'title' => 'required|string|max:255',
    //     'body' => 'required|string|max:1000',
    // ];

    
    public function store()
    {
        $user = Auth::user();
        $validate = $this->validate();
        $user->posts()->create($validate);
    }
    public function update(Post $post)
    {
        $validated = $this->validate();
        $post->update($validated);
    }

}
