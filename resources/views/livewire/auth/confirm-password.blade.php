<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header
        :title="'Konfirmasi Kata Sandi'"
        :description="'Ini adalah area aman aplikasi. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.'"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="confirmPassword" class="flex flex-col gap-6">
        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="'Kata Sandi'"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="'Kata Sandi'"
            viewable
            class="dark:bg-[#232946] dark:text-white dark:border-[#6366f1] dark:placeholder:text-zinc-400"
        />

        <flux:button variant="primary" type="submit" class="w-full py-3 text-lg dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:text-white dark:shadow-lg">{{ 'Konfirmasi' }}</flux:button>
    </form>
</div>
