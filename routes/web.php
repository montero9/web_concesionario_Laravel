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

//Ruta encargada de cambiar idioma
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

//Rutas inicio
Route::get('/','IndexController@index')->name('home');

//Recurso para mostrar listado de vehiculos desde la web de clientes
Route::get('/listaVehiculos','CarsController@index');

/*Rutas encargadas de control de usuarios*/
Auth::routes();

//Todas las rutas para los usuarios administradores
Route::group(['middleware' => 'checkisadmin'], function () {
    //Muestra el formulario de añadir usuario y un listado
    Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
    //Detalles de un usuario
    Route::get('user/{id}','Auth\UserDetailsController@details')->name('auth.userDetails');
    Route::post('user/{id}','Auth\UserDetailsController@details')->name('auth.userDetails');
    //Actualizar un usuario
    Route::patch('update/{user}','Auth\UserDetailsController@edit')->name('auth.editUser');
    //Eliminar un usuario
    Route::delete('delete/{user}','Auth\DeleteUser@delete')->name('auth.deleteUser');
    //Muestra las ventas de todos los usuarios
    Route::get('ventasadmin','VentasController@getAllVentas')->name('getVentasAdmin');

});

//Todas las rutas en las que hace falta estár autenticado para acceder
Route::group(['middleware' => 'auth'], function () {
    //Muestra las ventas del usuario logeado actualmente
    Route::get('ventasuser','VentasController@getVentasUser')->name('getVentasUser');
    //Muestra el detalle de una venta
    Route::get('venta/{id_venta}','VentasController@getSaleDetails')->name('getSaleDetails');
    //Muestra el formulario para crear una venta/presupuesto
    Route::get('formularioVenta','VentasController@showFormSale')->name('showFormSale');
    //Permite añadir una venta a la tabla
    Route::get('addSale','VentasController@addSale')->name('registerSale');
    //Permite imprimir una factura
    Route::get('sale/print/{id_venta}','VentasController@printPDF')->name('printSale');


    //Muestra la pagína principal del chat
    Route::get('/chat', 'ChatsController@index')->name('chat');
    //Carga los mensajes del chata
    Route::get('messages', 'ChatsController@fetchMessages');
    //Enviar un mensaje
    Route::post('messages', 'ChatsController@sendMessage');


    //Muestra un listado de todos los presupuestos
    Route::get('presupuestos','BudgetController@showListBudget')->name('showListBudget');
    //Muestra un formulario para añadir un presupusto
    Route::get('nuevoPresupuesto','BudgetController@showFormBudget')->name('showFormNewBudget');
    //Permite guardar los datos de un presupuesto en la bd
    Route::get('addBudget','BudgetController@addBudget')->name('addBudget');
    //Permite mostrar los detalles de un presupuesto
    Route::get('presupuesto/{id_budget}','BudgetController@getBudgetDetails')->name('getbudgetDetails');
    //Permite imprimir un presupuesto
    Route::get('presupuesto/print/{id_budget}','BudgetController@printPDF')->name('printBudget');
    //Formulario de presupuesto
    Route::get('presupuesto','BudgetController@showFormBudge')->name('showFormBudge');


    //Muestra el listado de modelos
    Route::get('modelos','ModelsController@getModels')->name('getModels');
    //Permite mostrar el formulario para un nuevo modelo
    Route::get('nuevomodelo','ModelsController@showFormModel')->name('showFormModel');
    //Eliminar modelo
    Route::get('deletemodel/{id_modelo}','ModelsController@deleteModel')->name('deleteModel');
    //Muestra el formulario para actualizar el modelo
    Route::get('updatemodel/{id_modelo}','ModelsController@showUpdateModel')->name('showUpdateModel');
    //Permite confirmar la actulización de un modelo
    Route::patch('updatemodel','ModelsController@updateModel')->name('updateModel');
    //Recoge datos del formulario y añade a la bd un modelo nuevo
    Route::post('upload','ModelsController@addModel')->name('uploadModel');

    //Muestra el listado de clientes
    Route::get('clientes','CustomersController@getCustomers')->name('getCustomers');
    //Muestra el formulario para añdir un nuevo cliente
    Route::get('nuevocliente','CustomersController@showFormCustomer')->name('showFormCustomer');
    //Guarda los datos recogidos del formulario en la bd
    Route::post('confirmarcliente','CustomersController@addCustomer')->name('addCustomer');
    //Mostramos el formulario para actualizar un cliente
    Route::get('updatecustomer/{id_cliente}','CustomersController@showUpdateCustomer')->name('showUpdateCustomer');
    //Confirma la actualización de un cliente
    Route::patch('updatecustomer','CustomersController@updateCustomer')->name('updateCustomer');
    //Elimina un cliente
    Route::delete('deletecustomer/{id_cliente}','CustomersController@deleteCustomer')->name('deleteCustomer');

    //Muestra el formulario de contacto clientes con el del destinatario relleno
    Route::get('contact/{email_cliente?}','SendEmailController@showForm')->name('showFormEmailCustomer');
    //Permite enviar un email
    Route::post('/contact/send', 'SendEmailController@send')->name('sendEmail');

    //Muestra el listado de vehiculos disponibles
    Route::get('vehiculos','CarsController@getCars')->name('getCars');
    //Muestra el formulario para añadir un nuevo vehículo
    Route::get('nuevovehiculo','CarsController@showFormCar')->name('showFormCar');
    //Guarda los datos recogidos del formulario en la bd
    Route::post('confirmarvehiculo','CarsController@addCar')->name('addCar');
    //Mostramos el formulario para añadir un nuevo vehículo
    Route::get('actulizarVehiculo/{id_vehiculo}','CarsController@showUpdateCar')->name('showUpdateCar');
    //Confirma la actualización de un cliente
    Route::patch('updatecar','CarsController@updateCustomer')->name('updateCar');
    //Elimina un vehiculo
    Route::delete('eliminarvehiculo/{id_vehiculo}','CarsController@deleteCustomer')->name('deleteCar');



});




