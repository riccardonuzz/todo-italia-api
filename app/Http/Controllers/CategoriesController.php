<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index() {
        return response()->json(Category::all());
    }

    public function show($id) {
        $category = Category::find($id);
        throw_if($category === null, new NotFoundHttpException('Category not found.'));
        return response()->json($category);
    }
}
