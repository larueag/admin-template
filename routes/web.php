<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gerar-usuarios', function () {
    $faker = \Faker\Factory::create('pt_BR');

    foreach(range(0,9) as $usuario){
        $name = $faker->firstName.' '.$faker->lastName;
        \Modules\Usuario\Models\Usuario::create([
            'nome' => $name,
            'email' => \Illuminate\Support\Str::slug($name, '.').'@'.$faker->freeEmailDomain,
            'login' => \Illuminate\Support\Str::slug($name, ''),
            'password' => bcrypt('secret'),
            'perfil_id' => 1
        ]);
        //$user->perfis()->attach(2);
    }

    return '10 usuários gerados';
});

Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['register' => false]);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'HomeController@index')->name('admin.home');
    });
});
