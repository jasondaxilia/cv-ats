<?php

use App\Http\Controllers\ResumeUploadController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

Route::post('/resumes/upload', [ResumeUploadController::class, 'store']);
Route::get('/templates/cv',     [TemplateController::class, 'download']);
