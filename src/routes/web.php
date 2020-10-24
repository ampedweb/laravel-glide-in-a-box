<?php
/**
 * Our image controller for glide
 */

use AmpedWeb\GlideInABox\Controller\GlideImageController;
use Illuminate\Support\Facades\Route;

Route::get('/img/{path}', [GlideImageController::class,'image'])->where('path', '.*')->name('glideinabox.image');
