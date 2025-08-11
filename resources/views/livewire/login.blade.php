<div class="min-h-screen flex items-center justify-center">
    <x-card 
        title="Login" 
        subtitle="Masuk ke akun Anda" 
        shadow 
        separator 
        class="w-full max-w-md bg-gray-800 border border-gray-700 rounded-lg p-6"
    >
        <x-form wire:submit="login">

            <x-input label="Email" wire:model="email" placeholder="Your email" icon="o-user" />
            <x-password label="Password" wire:model="password" right placeholder="Your password" icon="o-lock-closed" />
            <x-button type="submit" label="Login" class="w-full mt-6 mb-2" />

        </x-form>
    </x-card>
</div>
