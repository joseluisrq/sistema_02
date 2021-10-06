<?php

Route::group(['middleware' => ['cors']], function () {
  

    Route::group(['middleware'=>['guest']],function(){
        Route::get('/','Auth\LoginController@mostrarFormularioLogin'); 
        Route::post('/login','Auth\LoginController@login')->name('login');  
    });


    Route::group(['middleware'=>['auth']],function(){

        Route::get('/main', function () {
            return view('contenido/contenido');
        })->name('main'); 

        Route::post('/cerrarsesion','Auth\LoginController@cerrarSesion')->name('cerrarsesion'); 
        
        //middleware  para roles
        Route::group(['middleware'=>['Administrador']],function(){  
            //Cursos
            Route::get('/curso','CursoControlador@index');
               
        });
        Route::group(['middleware'=>['Operaciones']],function(){
        });

        Route::group(['middleware'=>['Cajero']],function(){
        });

    
        
        
    });

});
