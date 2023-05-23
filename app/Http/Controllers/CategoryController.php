<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function searchCategory(string $query): JsonResponse
    {
        try {
            $categories = Category::where('category_name', 'like', '%' . $query . '%')
                ->where('is_final', true)
                ->select('id', 'category_name', 'full_hierarchy')
                ->get();

            if ($categories->isEmpty()) {
                return response()->json([
                    'message' => 'No categories found.',
                ], 404);
            }

            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred.',
            ], 500);
        }
    }
}
