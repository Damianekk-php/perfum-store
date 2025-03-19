<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WelcomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('welcome', [
            'products' => Product::paginate(10)
        ]);
    }
}
