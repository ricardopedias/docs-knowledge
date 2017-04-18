<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('plexi', function(){
	echo 'Hello from the plexi package!';
});

Route::get('add/{a}/{b}', 'Plexi\Foundation\Http\Controllers\ExampleController@add');
Route::get('subtract/{a}/{b}', 'Plexi\Foundation\Http\Controllers\ExampleController@subtract');
