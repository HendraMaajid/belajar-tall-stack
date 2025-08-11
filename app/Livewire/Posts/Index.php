<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Title('Posts')]
class Index extends Component
{
    use WithPagination;
    use Toast;

    public int $perPage = 6;
    public ?int $selectedUser = null;
    // Selected option
    public array $users_multi_searchable_ids = [];
    public Collection $usersMultiSearchable;

    public function mount()
    {
        // Fill options when component first renders
        $this->search();
    }
    public function search(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        // Ambil data user yang sudah dipilih supaya tetap muncul
        $selectedOptions = User::where('id', $this->users_multi_searchable_ids)->get();

        // Query pencarian
        $this->usersMultiSearchable = User::query()
            ->where(DB::raw('LOWER(name)'), 'like', "%{$value}%")
            ->orderBy('name')
            ->take(5)
            ->get()
            ->merge($selectedOptions)
            ->unique('id'); // Hindari duplikasi
    }


    public function Posttez(): LengthAwarePaginator
    {
        $posts = Post::query()
            ->when($this->selectedUser, function ($query) {
                $query->where('user_id', $this->selectedUser);
            })
            ->when(!empty($this->users_multi_searchable_ids), function ($query) {
                $query->whereIn('user_id', $this->users_multi_searchable_ids);
            })
            ->latest()
            ->paginate($this->perPage);

        return $posts;
    }
    public function render()
    {
        $user = User::all();
        $posts = $this->Posttez();

        return view('livewire.posts.index', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }
    public function delete(Post $post)
    {
        $post->delete();
        $this->success('Post deleted successfully!', redirectTo: route('posts.index'));
    }

}