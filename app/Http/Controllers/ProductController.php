<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('products.index', [
            'products' => Product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create', [
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertProductRequest $request)
    {
        $product = new Product($request->validated());
        if ($request->hasfile('image')) {
            $product->image_path = $request->file('image')->store('products', );
        }
        $product->save();

        return redirect()->route('products.index')->with('status', 'Produkt został dodany!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertProductRequest $request, Product $product)
    {
        $oldImagePath = $product->image_path;
        $product->fill($request->validated());
        if ($request->hasfile('image')) {
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
            $product->image_path = $request->file('image')->store('products', );
        }
        $product->save();

        return redirect()->route('products.index')->with('status', 'Produkt został zaktualizowany!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('status', 'Produkt został usunięty.');
    }

    public function downloadImage(Product $product): RedirectResponse|StreamedResponse
    {
           if (Storage::exists($product->image_path)) {

                return Storage::download($product->image_path, $product->name);

           }

        return Redirect::back();
    }
}
