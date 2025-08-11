<?php

namespace App\Livewire\Posts;

use App\Livewire\Forms\Postform;
use App\Models\Post;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;
    public Postform $form;
    public ?Post $post = null;

    public function mount()
    {
        if ($this->post) {
            $this->form->fill($this->post);
        }
    }

    public function save()
    {
        if ($this->post) {
            $this->form->update($this->post);
            $this->success('Post updated successfully!', redirectTo: route('posts.index'));
        } else {
            $this->form->store();
            $this->success('Post created successfully!', redirectTo: route('posts.index'));
        }
    }

    public function render()
    {
        return view('livewire.posts.create');
    }
}
