<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 3;

        if(request()->has('search')) {
            $search = strtolower(request('search'));
            $data = Todo::whereRaw('LOWER(task) LIKE ?', ['%' . $search . '%'])
                        ->orderBy('task', 'asc')
                        ->paginate($max_data)
                        ->withQueryString();
        } else {
            $data = Todo::orderBy('task', 'asc')->paginate($max_data);
        }

        return view('todo.app', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'task' => 'required|min:4|max:255',
            ],
            [
                'task.required' => 'Task harus diisi',
                'task.min' => 'Task minimum 4 karakter',
                'task.max' => 'Task maksimal 255 karakter',
            ]
        );

        $data = [
            'task' => $request->input('task'),
        ];

        Todo::create($data);

        return redirect()->route('todo')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'task' => 'required|min:4|max:255',
            ],
            [
                'task.required' => 'Task harus diisi',
                'task.min' => 'Task minimum 4 karakter',
                'task.max' => 'Task maksimal 255 karakter',
            ]
        );

        $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done'),
        ];

        Todo::where('id', $id)->update($data);
        return redirect()->route('todo')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todo')->with('success', 'Data berhasil dihapus');
    }
}
