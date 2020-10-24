<?php
/**
 * Our image controller for glide
 */

use AmpedWeb\GlideInABox\Controller\GlideImageController;
use Illuminate\Support\Facades\Route;

Route::get('/img/preset/{size}/{?encoding}', [GlideImageController::class, 'preset'])->name('glideinabox.preset');
Route::get('/img/{path}', [GlideImageController::class,'custom'])->where('path', '.*')->name('glideinabox.custom');
