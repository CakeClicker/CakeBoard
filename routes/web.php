<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

use App\Http\Controllers\DiscordController;

Route::get('/discord-login', [DiscordController::class, 'showLoginForm'])->name('discord.login');
Route::post('/discord-login', [DiscordController::class, 'login'])->name('discord.login.post');
Route::get('/discord-servers', [DiscordController::class, 'listServers'])->name('discord.servers')->middleware('auth');
Route::get('/discord/server/{serverId}/stats', [DiscordController::class, 'getServerStats'])->name('discord.server.stats');


require __DIR__.'/auth.php';
