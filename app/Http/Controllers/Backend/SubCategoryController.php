<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function create ()
    {
        $categories = Category::get();
        return view ('backend.subcategory.create', compact('categories'));
    }
}
