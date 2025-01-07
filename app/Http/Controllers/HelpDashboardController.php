<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            // Если пользователь авторизован, перенаправляем в личный кабинет помощи
            return view('help.dashboard');
        }

        // Если не авторизован, перенаправляем на страницу авторизации
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('help.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Обработка сохранения ресурса
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('help.show', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('help.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Обновление ресурса
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Удаление ресурса
    }
}
