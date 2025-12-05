<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\PageController;
use App\Http\Controllers\Website\ClientMessageController;
use App\Http\Controllers\Website\BookingController;


use App\Http\Controllers\Website\Auth\LoginController;
use App\Http\Controllers\Website\Auth\RegisterController;
use App\Http\Controllers\Website\Auth\ClientPasswordResetLinkController;
use App\Http\Controllers\Website\Auth\NewClientPasswordController;



use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\Admin\ClientController;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        /*
        |--------------------------------------------------------------------------
                                   (Website Routes) 
        |--------------------------------------------------------------------------
        */

        Route::name('website.')->group(function () {
            /*
        |--------------------------------------------------------------------------
        | Home Routes 
        |--------------------------------------------------------------------------
        */
            Route::get('/', [PageController::class, 'index'])->name('page');
            Route::post('/message/save', [ClientMessageController::class, 'store'])->name('messages.store');

            /*
        |--------------------------------------------------------------------------
        | Auth Routes 
        |--------------------------------------------------------------------------
        */
            Route::get('login-view', [LoginController::class, 'loginView'])->name('login');
            Route::post('login-submit', [LoginController::class, 'login'])->name('login.submit');
            Route::get('register-view', [RegisterController::class, 'registerView'])->name('register');
            Route::post('register-submit', [RegisterController::class, 'register'])->name('register.submit');

            /*
        |--------------------------------------------------------------------------
        | Reset Password Routes 
        |--------------------------------------------------------------------------
        */
            Route::get('forget-password', [ClientPasswordResetLinkController::class, 'create'])
                ->name('password.request');

            Route::post('forgot-password', [ClientPasswordResetLinkController::class, 'store'])
                ->name('password.email');

            Route::get('website/reset-password/{token}', [NewClientPasswordController::class, 'create'])
                ->name('password.reset');

            Route::post('client-reset-password', [NewClientPasswordController::class, 'store'])
                ->name('password.store');

            /*
        |--------------------------------------------------------------------------
        |  Authenticated Client Routes
        |--------------------------------------------------------------------------
        */

            Route::prefix('client')->middleware('auth:client')->group(function () {
                Route::post('logout', [LoginController::class, 'logout'])->name('logout');
                // Profile Routes
                /*
        |--------------------------------------------------------------------------
        |  Profile Routes
        |--------------------------------------------------------------------------
        */
                Route::prefix('profile')->group(function () {
                    Route::get('edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
                    Route::put('update', [ProfileController::class, 'update'])->name('profile.update');
                    Route::delete('destroy/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');

                    Route::get('password', [ProfileController::class, 'password'])->name('profile.password');
                    Route::put('password/update/{id}', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
                });

                /*
        |--------------------------------------------------------------------------
        |  Bookings Routes
        |--------------------------------------------------------------------------
        */
                Route::prefix('bookings')->group(function () {
                    Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
                    Route::get('show', [BookingController::class, 'clientBooking'])->name('bookings.show');
                    Route::post('save/{id}', [BookingController::class, 'bookAppointment'])->name('booking.store');
                    Route::delete('delete/{id}', [BookingController::class, 'delete'])->name('booking.destroy');
                    Route::delete('delete-all', [BookingController::class, 'deleteAll'])->name('booking.destroy.all');
                });
            });
        });
        /*
        |--------------------------------------------------------------------------
        |                          (End Website Routes) 
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        |                              (Admin Routes)
        |--------------------------------------------------------------------------
        */

        Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

            Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

            /*
        |--------------------------------------------------------------------------
        |  Users Routes
        |--------------------------------------------------------------------------
        */
            Route::prefix('user')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('users.index');
                Route::get('create', [UserController::class, 'create'])->name('user.create');
                Route::post('save', [UserController::class, 'store'])->name('user.store');
                Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
                Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');
                Route::get('password', [UserController::class, 'password'])->name('user.password');
                Route::put('password/update/{id}', [UserController::class, 'pass'])->name('user.password.update');
                Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
            });

            /*
        |--------------------------------------------------------------------------
        |  Roles Routes
        |--------------------------------------------------------------------------
        */
            Route::prefix('role')->group(function () {
                Route::get('/', [RoleController::class, 'index'])->name('roles.index');
                Route::get('create', [RoleController::class, 'create'])->name('role.create');
                Route::post('save', [RoleController::class, 'store'])->name('role.store');
                Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
                Route::put('update/{id}', [RoleController::class, 'update'])->name('role.update');
                Route::delete('delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
            });

            /*
        |--------------------------------------------------------------------------
        |  Clients Routes
        |--------------------------------------------------------------------------
        */
            Route::prefix('client')->group(function () {
                Route::get('/', [ClientController::class, 'index'])->name('clients.index');
                Route::get('edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
                Route::put('update/{id}', [ClientController::class, 'update'])->name('client.update');
                Route::delete('delete/{id}', [ClientController::class, 'destroy'])->name('client.destroy');
            });

            /*
        |--------------------------------------------------------------------------
        |  Departments Routes
        |--------------------------------------------------------------------------
        */
            Route::prefix('departments')->group(function () {
                Route::get('/', [DepartmentController::class, 'index'])->name('departments.index');
                Route::get('create', [DepartmentController::class, 'create'])->name('department.create');
                Route::post('save', [DepartmentController::class, 'store'])->name('department.store');
                Route::delete('delete/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
            });


            /*
        |--------------------------------------------------------------------------
        |  Doctors Routes
        |--------------------------------------------------------------------------
        */
            Route::prefix('doctors')->group(function () {
                Route::get('/', [DoctorController::class, 'index'])->name('doctors.index');
                Route::get('create', [DoctorController::class, 'create'])->name('doctor.create');
                Route::post('save', [DoctorController::class, 'store'])->name('doctor.store');
                Route::get('edit/{id}', [DoctorController::class, 'edit'])->name('doctor.edit');
                Route::put('update/{id}', [DoctorController::class, 'update'])->name('doctor.update');
                Route::delete('delete/{id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');


                /*
        |--------------------------------------------------------------------------
        |  Doctors Schedules Routes
        |--------------------------------------------------------------------------
        */
                Route::get('/Schedules', [DoctorScheduleController::class, 'index'])->name('schedules.index');
                Route::get('Schedules/create/{id}', [DoctorScheduleController::class, 'createSchedule'])->name('schedule.create');
                Route::post('Schedules/save', [DoctorScheduleController::class, 'storeSchedule'])->name('schedule.store');
                Route::get('Schedules/edit/{id}', [DoctorScheduleController::class, 'editSchedule'])->name('schedule.edit');
                Route::put('Schedules/update/{id}', [DoctorScheduleController::class, 'updateSchedule'])->name('schedule.update');
            });

            /*
        |--------------------------------------------------------------------------
        |  Messages Routes
        |--------------------------------------------------------------------------
        */
            Route::prefix('messages')->group(function () {
                Route::get('/', [MessageController::class, 'index'])->name('messages.index');
                Route::delete('delete/{id}', [MessageController::class, 'destroy'])->name('message.destroy');
            });
        });
    }
);
require __DIR__ . '/auth.php';
