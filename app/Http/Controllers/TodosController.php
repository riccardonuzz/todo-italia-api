<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index() {
        $todo = Todo::latest()
                    ->where('user_id', auth()->user()->id)
                    ->filter(request(['search', 'category', 'done']))
                    ->get();
            
        return response()->json($todo);
            
    }

    public function show($id) {
        return Todo::find($id)
            ->where('user_id', auth()->user()->id)
            ->toJson();
    }

}
