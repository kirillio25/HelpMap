<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HelpDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $points = Point::where('is_active', 1)
                ->where('user_id', auth()->id())
                ->get();

            return view('help.dashboard', compact('points'));
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
        try {
            // Преобразуем строку местоположения в массив
            if (is_string($request->location)) {
                // Разделяем строку по запятой и преобразуем в массив
                $locationParts = explode(',', $request->location);
                $request->merge([
                    'location' => [
                        'latitude' => trim($locationParts[0]),
                        'longitude' => trim($locationParts[1])
                    ]
                ]);
            }

            // Валидация
            $request->validate([
                'fullName' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'description' => 'required|string|max:1000',
                'location' => 'required|array',
                'location.latitude' => 'required|numeric',
                'location.longitude' => 'required|numeric',
            ]);

            // Сохранение данных в БД
            Point::create([
                'user_id' => auth()->id(),
                'fullName' => $request->fullName,
                'phone' => $request->phone,
                'description' => $request->description,
                'location' => json_encode($request->location), // Преобразуем в JSON
                'is_active' => true,
            ]);

            // Перенаправление с успешным сообщением
            return redirect()->route('help-dashboard.index')->with('success', 'Данные успешно добавлены!');
        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при добавлении данных в базу', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Перенаправление с ошибкой
            return redirect()->back()->withErrors('Произошла ошибка при сохранении данных.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $point = Point::findOrFail($id);

        return view('help.show', compact('point'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $point = Point::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('help.edit', compact('point'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'description' => 'required|string|max:1000',
            'location' => 'required|string',
        ]);

        $point = Point::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $point->update([
            'fullName' => $request->fullName,
            'phone' => $request->phone,
            'description' => $request->description,
            'location' => $request->location,
        ]);

        return redirect()->route('help-dashboard.index')->with('success', 'Запись успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $point = Point::findOrFail($id);

        // Убедись, что пользователь может удалить запись
        if ($point->user_id == auth()->id()) {
            $point->delete();
            return redirect()->route('help-dashboard.index')->with('success', 'Запись удалена!');
        }

        return back()->with('error', 'Вы не можете удалить чужую запись.');
    }

}
