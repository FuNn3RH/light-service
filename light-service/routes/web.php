<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Hoosh\BackupController;
use App\Livewire\Share\Share;
use App\Livewire\Hoosh\Auth\Login;
use Illuminate\Support\Facades\Route;
use App\Livewire\Hoosh\Admin\Users\UserForm;
use App\Http\Controllers\Rust\RustController;
use App\Livewire\Hoosh\Admin\Users\UsersPage;
use App\Livewire\Hoosh\Admin\Review\ReviewPage;
use App\Livewire\Hoosh\Admin\Users\UsersAnswers;
use App\Livewire\Hoosh\Users\Answers\AnswerPage;
use App\Http\Controllers\Hoosh\RedirectController;
use App\Livewire\Hoosh\Users\Questions\QuestionForm;
use App\Livewire\Hoosh\Users\Dashboard\DashboardPage;
use App\Livewire\Hoosh\Users\Questions\QuestionsList;
use App\Http\Controllers\PowerSchedule\PowerController;
use App\Livewire\Hoosh\Admin\SubQuestion\SubQuestionForm;
use App\Livewire\Hoosh\Admin\MainQuestion\MainQuestionForm;
use App\Livewire\Hoosh\Admin\MainQuestion\MainQuestionPage;
use App\Livewire\Hoosh\Users\MainQuestions\MainQuestionList;
use App\Http\Controllers\PowerSchedule\ServiceWorkerController;
use App\Livewire\Hoosh\Admin\Dashboard\Dashboard as AdminDashboard;
use App\Livewire\Hoosh\Admin\UserMainQuestion\UserMainQuestionPage;
use App\Livewire\Hoosh\Admin\SubQuestion\MainQuestionPage as SubQuestionMainQuestionPage;
use Illuminate\Support\Facades\Auth;

Route::middleware('main.auth')->group(function () {
    Route::prefix('share')->group(function () {
        Route::get('/', Share::class)->name('share.index');
    });

    Route::prefix('power-schedules')->group(function () {
        Route::get('/', [PowerController::class, 'index'])->name('power-schedules.index');
        Route::get('/reports', [PowerController::class, 'getReport'])->name('power-schedules.get.reports');
        Route::get('/sw', [ServiceWorkerController::class, 'index'])->name('power-schedules.sw');
        Route::get('/offline', [ServiceWorkerController::class, 'offline'])->name('power-schedules.offline');
        Route::get('/power-schedules/offline-data', [ServiceWorkerController::class, 'offlineData']);
    });

    Route::prefix('rust')->group(function () {
        // Route::get('/', RustController::class)->name('rust.index');
        Route::get('/', [RustController::class, 'treasure'])->name('rust.treasure');
        Route::post('/', [RustController::class, 'findTreasure'])->name('rust.treasure.find');
        Route::get('/logs', [RustController::class, 'logs'])->name('rust.treasure.logs');
        Route::get('/map', [RustController::class, 'map'])->name('rust.treasure.map');
    });
});

Route::prefix('hoosh')->group(function () {
    Route::redirect('/', '/hoosh/redirect');
    Route::get('/login', Login::class)->name('hoosh.login');
    Route::get('/redirect', [RedirectController::class, '__invoke'])->name('hoosh.redirect');

    Route::middleware('is.login')->group(function () {
        Route::prefix('admin')->middleware('is.admin')->group(function () {
            Route::get('/dashboard', AdminDashboard::class)->name('hoosh.admin.dashboard');

            Route::prefix('questions')->group(function () {
                Route::get('/', MainQuestionPage::class)->name('hoosh.admin.questions.index');
                Route::get('/create-edit/{question?}', MainQuestionForm::class)->name('hoosh.admin.questions.create-edit');

                Route::prefix('/{mainQuestion}/sub-questions')->group(function () {
                    Route::get('/', SubQuestionMainQuestionPage::class)->name('hoosh.admin.questions.sub-questions.index');
                    Route::get('/create-edit/{subQuestion?}', SubQuestionForm::class)->name('hoosh.admin.questions.sub-questions.create-edit');
                });

                Route::prefix('users')->group(function () {
                    Route::get('/', UsersPage::class)->name('hoosh.admin.users');
                    Route::get('/create-edit/{user?}', UserForm::class)->name('hoosh.admin.users.create-edit');
                    Route::get('/{user}/main-questions', UserMainQuestionPage::class)->name('hoosh.admin.user-main-questions');
                    Route::get('/{user}/answers', UsersAnswers::class)->name('hoosh.admin.users.answers');
                });
            });

            Route::get('/review/{answer}', ReviewPage::class)->name('hoosh.admin.reviews.index');
        });

        Route::middleware('is.login')->group(function () {
            Route::get('/dashboard', DashboardPage::class)->name('hoosh.users.dashboard');
            Route::get('answers/{answer}', AnswerPage::class)->name('hoosh.users.answer');
            Route::get('/main-questions', MainQuestionList::class)->name('hoosh.users.main-questions');
            Route::get('/questions/{mainQuestion}', QuestionsList::class)->name('hoosh.users.questions');
            Route::get('/start/{mainQuestion}', QuestionForm::class)->name('hoosh.users.start');
        });
    });

    Route::get('/sw', function () {
        return response()->file(public_path('assets/hoosh/js/sw.js'), [
            'Content-Type' => 'application/javascript',
        ]);
    });

    Route::get('/backup', BackupController::class);
});

Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.login');

Route::prefix('company')->group(function () {
    Route::redirect('/', '/company/shimiteb');
    Route::view('/shimiteb', 'companies.shimiteb');
});
