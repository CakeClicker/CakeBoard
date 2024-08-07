<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

new class extends Component {
    use WithFileUploads;

    // For updating profile picture
    public $profile_picture;

    public function updateProfilePicture()
    {
        // Validate the uploaded profile picture
        $this->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $user = Auth::user();

        // If a profile picture already exists, delete it
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Store the new profile picture and get the path
        $path = $this->profile_picture->store('profile_pictures', 'public');

        // Update the user's profile picture path
        $user->profile_picture = $path;
        $user->save();
        Toaster::success('Profile updated!'); // 👈


    }

}; ?>

<section>
    <!-- Update Profile Picture Section -->
    <header class="mt-12">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Upload a new profile picture to update your account.') }}
        </p>
    </header>

    <form wire:submit.prevent="updateProfilePicture" method="POST" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center space-x-4">
            <div class="w-24 h-24 rounded-full overflow-hidden">
                <img
                    src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp' }}"
                    alt="Profile Picture"
                    class="w-full h-full object-cover"
                />
            </div>
            <div class="flex-1">
                <label for="profile_picture" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Choose a new profile picture:') }}
                </label>
                <input
                    type="file"
                    id="profile_picture"
                    wire:model="profile_picture"
                    class="mt-1 block w-full"
                />
                @error('profile_picture')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-4 btn btn-primary">
                    {{ __('Upload') }}
                </button>
            </div>
        </div>
    </form>
</section>



