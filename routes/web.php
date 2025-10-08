<?php

use App\Http\Controllers\HabeahanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', [LandingController::class, 'index'])->name('landing');

// PROFIL

Route::get('visi-misi', function () {
    return view('landing.profil.visi-misi');
})->name('visi-misi');

// TAROMBO
Route::get('/tarombo/raja-pasaribu', [LandingController::class, 'rajaPasaribu'])->name('raja-pasaribu');

Route::get('/tarombo/habeahan', [LandingController::class, 'habeahan'])->name('habeahan');
Route::get('/tarombo/habeahan/detail', [LandingController::class, 'habeahanDetail'])->name('habeahan.detail');

Route::get('/tarombo/gorat', [LandingController::class, 'gorat'])->name('gorat');
Route::get('/tarombo/gorat/detail', [LandingController::class, 'goratDetail'])->name('gorat.detail');

Route::get('/tarombo/bondar', [LandingController::class, 'bondar'])->name('bondar');
Route::get('/tarombo/bondar/detail', [LandingController::class, 'bondarDetail'])->name('bondar.detail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    $resources = [
        [
            'name' => 'users',
            'controller' => UserController::class,
        ],
        [
            'name' => 'habeahan',
            'controller' => HabeahanController::class,
        ],
    ];

    foreach ($resources as $resource) {
        Route::resource($resource['name'], $resource['controller']);
    }
});



// Route::get('/test', function () {

//     $path = base_path('database/source/habeahan.xlsx');

//     $rows = Excel::toCollection(null, $path)->first();

//     $rows = $rows->skip(2);

//     $data = [];

//     foreach ($rows as $index => $row) {

//         $row = $row->skip(1);

//         foreach ($row as $r) {
//             if ($r != null) {
//                 $data[$index] = parseLine($r);

//                 $parent = null;

//                 if (! isset($data[$index]['sundut'])) {
//                     dd($index, $r, $row);
//                 }

//                 $thisGeneration = $data[$index]['sundut'];

//                 $parentSundut = $thisGeneration - 1;

//                 if ($thisGeneration > 1) {

//                     $reversed = array_reverse($data);

//                     foreach ($reversed as $k => $d) {
//                         if ($d['sundut'] == $parentSundut) {
//                             $parent = $d;
//                             $data[$index]['orang_tua'] = [
//                                 'name' => $parent['nama'],
//                                 'index' => $parent['id'],
//                             ];
//                             break;
//                         }
//                     }
//                 } else {
//                     $data[$index]['orang_tua'] = null;
//                 }
//             }
//         }

//     }

//     dd($data);
// });

require __DIR__.'/auth.php';
