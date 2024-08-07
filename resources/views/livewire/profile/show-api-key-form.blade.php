<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Volt\Component;
use Masmerise\Toaster\Toaster;

new class extends Component {
    public $api_key;

    public function regenerateApiKey(): void
    {
        $user = Auth::user();
        $user->api_key = Str::random(64); // Generate a new API key
        $user->save();

        $this->api_key = $user->api_key;
        Toaster::success('Profile updated!'); // 👈


        /*$this->dispatchBrowserEvent('api-key-updated');*/
    }
}; ?>

<section>
    <!-- API Key Management Section -->
    <header class="mt-12">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('API Key Management') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Manage your API key. You can regenerate it if needed.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <div class="flex items-center space-x-4">
            <div class="flex-1">
                <label for="api_key" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('API Key:') }}
                </label>
                <input
                    type="text"
                    id="api_key"
                    class="mt-1 block w-full"
                    value="{{ Auth::user()->api_key  ?? null}}"
                    readonly
                />
                <small class="form-text text-muted">{{ __('Your unique API key. Keep it safe.') }}</small>
            </div>
        </div>

        <button type="button" wire:click="regenerateApiKey()" class="mt-4 btn btn-primary">
            {{ __('Regenerate API Key') }}
        </button>
    </div>
</section>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('api-key-updated', function () {
            alert('API Key has been updated.');
        });
    });
</script>




