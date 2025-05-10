<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/', function () {
    $response = Http::get('http://golang-api:8080/tasks');
    $tasks = $response->json();

    $active = $tasks['incomplete_tasks'] ?? [];
    $done = $tasks['completed_tasks'] ?? [];

    return view('home', compact('active', 'done'));
});

Route::post('/tasks', function (Request $request) {
    $response = Http::post('http://golang-api:8080/tasks', [
        'title' => $request->title,
    ]);

    return redirect('/');
});

Route::put('/tasks/{id}', function (Request $request, $id) {
    $response = Http::put("http://golang-api:8080/tasks/{$id}", [
        'title' => $request->title,
    ]);

    return redirect('/');
});

Route::patch('/tasks/{id}/done', function (Request $request, $id) {
    $response = Http::patch("http://golang-api:8080/tasks/{$id}/done");
    return redirect('/');
});

Route::delete('/tasks/{id}', function (Request $request, $id) {
    $response = Http::delete("http://golang-api:8080/tasks/{$id}");
    return redirect('/');
});
