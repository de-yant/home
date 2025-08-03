<?php

// Admin
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitRumahController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\ProfileController;

// pengawas
use App\Http\Controllers\PengawasDashboardController;
use App\Http\Controllers\PengawasProgressController;
use App\Http\Controllers\PengawasEvaluasiController;

// Guest
use App\Http\Controllers\GuestController;
// laravel
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'pengawas' => redirect()->route('pengawas.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // jika url admin saja maka redirect ke dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('index');

    // Halaman dashboard
    Route::resource('dashboard', DashboardController::class)->only(['index'])->names([
        'index' => 'dashboard',
    ]);

    // Halaman masterdata
    Route::prefix('masterdata')->name('masterdata.')->group(function () {
        Route::resource('unit-rumah', UnitRumahController::class);
        Route::resource('progress', ProgressController::class);
    });

    // Resource CRUD
    Route::resource('evaluasi', EvaluasiController::class);

    // Pengaturan pengguna (settings)
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/users', [UserSettingController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserSettingController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserSettingController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserSettingController::class, 'destroy'])->name('users.destroy');
        Route::patch('/users/{user}/toggle', [UserSettingController::class, 'toggle'])->name('users.toggle');
        Route::patch('/users/{user}/role', [UserSettingController::class, 'updateRole'])->name('users.role');
    });
});


// pengawas routes
Route::middleware(['auth', 'verified'])
    ->prefix('pengawas')
    ->name('pengawas.')
    ->group(function () {
    // jika url pengawas saja maka redirect ke dashboard
    Route::get('/', function () {
        return redirect()->route('pengawas.dashboard');
    })->name('index');

    // Halaman dashboard
    Route::get('/dashboard', [PengawasDashboardController::class, 'index'])->name('dashboard');

    // Resource CRUD untuk progress
    Route::resource('progress', PengawasProgressController::class);

    // Route untuk halaman evaluasi
    Route::resource('evaluasi', PengawasEvaluasiController::class);

});

// Route publik
Route::get('/search', [App\Http\Controllers\ProgressController::class, 'search'])->name('progress.search');
Route::get('/guest/evaluasi/form/{unit}', [App\Http\Controllers\GuestController::class, 'form'])->name('guest.evaluasi.form');
Route::post('/guest/evaluasi/store', [App\Http\Controllers\GuestController::class, 'store'])->name('guest.evaluasi.store');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
