<?php

use App\Livewire\User;
use App\Livewire\Region;
use App\Livewire\Profile;
use App\Livewire\Pengajuan;
use App\Livewire\User\Role;
use App\Livewire\UserIndex;
use App\Livewire\Pengumuman;
use App\Livewire\Pengumpulan;
use App\Livewire\RegionIndex;
use App\Livewire\User\ListRole;
use App\Livewire\JenisPengajuan;
use App\Livewire\BackgroundLogin;
use App\Livewire\DetailPengajuan;
use App\Livewire\User\Permission;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::resource('register', RegisterController::class);

Route::get('docs', function () {
    return File::get(public_path() . '/documentation.html');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('list-role', ListRole::class)->name('list-role');
        Route::get('permission', Permission::class)->name('permission');
        Route::get('role/{id?}', Role::class)->name('role');
        Route::get('jenis-pengajuan', JenisPengajuan::class)->name('jenis-pengajuan');
        Route::get('pengumuman', Pengumuman::class)->name('pengumuman');
        Route::get('pengajuan', Pengumpulan::class)->name('pengajuan');
        Route::get('user-index', UserIndex::class)->name('user-index');
        Route::get('user/{id?}', User::class)->name('user');
        Route::get('background', BackgroundLogin::class)->name('background');
        Route::get('region-index', RegionIndex::class)->name('region-index');
        Route::get('region/{id?}', Region::class)->name('region');
    });

    Route::get('/pengajuan/{id?}', Pengajuan::class)->name('pengajuan');
    Route::get('/detail-pengajuan/{id?}', DetailPengajuan::class)->name('detail.pengajuan');
    Route::get('profile/{id?}', Profile::class)->name('profile');


});
