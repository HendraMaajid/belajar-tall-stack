<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Home')]
#[Layout('components.layouts.app')]
class Home extends Component
{
    use WithPagination;

    public int $perPage = 10;
    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $users = User::query()
            ->when($this->search, function ($query) {
                $search = strtolower($this->search); // ubah keyword ke lowercase

                $query->where(DB::raw('LOWER(name)'), 'like', "%{$search}%")
                    ->orWhere(DB::raw('LOWER(email)'), 'like', "%{$search}%");
            })
            ->paginate($this->perPage);

        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'w-16'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'font-medium'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'created_at', 'label' => 'Joined', 'class' => 'w-32'],
        ];

        return view('livewire.home.index', [
            'users' => $users,
            'headers' => $headers
        ]);
    }
}