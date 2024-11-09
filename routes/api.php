<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\AdminController;

// Category Routes
Route::get('/categories', [CategoryController::class, 'index']); // Get all categories
Route::post('/categories', [CategoryController::class, 'store']); // Create a new category
Route::put('/categories/{id}', [CategoryController::class, 'update']); // Update a category
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']); // Delete a category

// Item Routes
Route::get('/items', [ItemController::class, 'index']); // Get all items
Route::post('/items', [ItemController::class, 'store']); // Create a new item
Route::put('/items/{id}', [ItemController::class, 'update']); // Update an item
Route::delete('/items/{id}', [ItemController::class, 'destroy']); // Delete an item

// Order Routes
Route::get('/orders', [OrderController::class, 'index']); // Get all orders
Route::post('/orders', [OrderController::class, 'store']); // Create a new order

// Receipt Routes
Route::get('/receipts', [ReceiptController::class, 'index']); // Get all receipts
Route::post('/receipts', [ReceiptController::class, 'store']); // Generate a new receipt

// Admin Dashboard Routes
Route::get('/admin/daily-summary', [AdminController::class, 'getDailySummary']); // Get daily summary of receipts and revenue
