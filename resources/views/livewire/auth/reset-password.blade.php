<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PasswordReset) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="'Reset Kata Sandi'" :description="'Silakan masukkan kata sandi baru Anda di bawah ini'" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="resetPassword" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="'Alamat Email'"
            type="email"
            required
            autocomplete="email"
            class="dark:bg-[#232946] dark:text-white dark:border-[#6366f1] dark:placeholder:text-zinc-400"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="'Kata Sandi Baru'"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="'Kata Sandi baru'"
            viewable
            class="dark:bg-[#232946] dark:text-white dark:border-[#6366f1] dark:placeholder:text-zinc-400"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="'Konfirmasi Kata Sandi'"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="'Konfirmasi kata sandi'"
            viewable
            class="dark:bg-[#232946] dark:text-white dark:border-[#6366f1] dark:placeholder:text-zinc-400"
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full py-3 text-lg dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:text-white dark:shadow-lg">
                {{ 'Reset kata sandi' }}
            </flux:button>
        </div>
    </form>
</div>
