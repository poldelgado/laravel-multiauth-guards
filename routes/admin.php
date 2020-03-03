<?php

use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


Route::get('/dashboard', 'DashboardController@index')->name('admin_dashboard');


Route::catch(function () {
    throw new NotFoundHttpException("Pag no encontrada");
});
