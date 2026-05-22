<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        // Mengambil semua data tugas yang ada di database tanpa memfilter ID user
        $todos = Todo::latest()->get();
        return view('index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        // Menyimpan tugas baru tanpa mengisi user_id
        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, Todo $todo)
    {
        // Langsung memperbarui status tanpa memvalidasi kepemilikan user
        $todo->update([
            'is_completed' => $request->has('is_completed') ? true : false
        ]);

        return redirect()->back();
    }

    public function destroy(Todo $todo)
    {
        // Langsung menghapus data tugas
        $todo->delete();
        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }
}