<?php

use App\Http\Controllers\CmsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [ResumeController::class, 'index'])->name('HomePage');

Route::post('/contact', [ContactController::class, 'sendMessage'])->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [ResumeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cms',[CmsController::class, 'index'])->name('cms');
    Route::post('/userData',[UserController::class, 'update'])->name('userData');

    Route::post('/skills',[SkillController::class, 'store'])->name('skill.store');
    Route::patch('/skills/{skill}',[SkillController::class, 'update'])->name('skills.patch');
    Route::delete('/skills/{skill}',[SkillController::class, 'destroy'])->name('skills.destroy');

    Route::post('/languages', [LanguageController::class, 'store'])->name('languages.store');
    Route::patch('/languages/{language}', [LanguageController::class, 'update'])->name('languages.patch');
    Route::delete('/languages/{language}', [LanguageController::class, 'destroy'])->name('languages.destroy');

    Route::post('/educations', [EducationController::class, 'store'])->name('educations.store');
    Route::patch('/educations/{education}', [EducationController::class, 'update'])->name('educations.patch');
    Route::delete('/educations/{education}', [EducationController::class, 'destroy'])->name('educations.destroy');

    Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store');
    Route::patch('/experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.patch');
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::patch('/projects/{project}', [ProjectController::class, 'update'])->name('projects.patch');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

require __DIR__.'/auth.php';
