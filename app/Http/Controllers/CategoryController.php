<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function searchCategory(string $query)
    {
        $data = Category::where('category_name', 'like', '%'.$query.'%')
        ->where('is_final', true)
        ->select('id', 'category_name', 'full_hierarchy')->get();
        return response()->json($data);
    }
}
