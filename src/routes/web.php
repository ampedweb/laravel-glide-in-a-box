<?php
/**
 * Our image controller for glide
 */

use AmpedWeb\GlideInABox\Controller\GlideImageController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('glideinabox.base_url'))->group(function () {
    Route::get('{path}', [GlideImageController::class, 'image'])->where('path', '.*')->name('glideinabox.image');
});

//Route::group(['prefix' => config('glideinabox.base_url')], function () {
//});
