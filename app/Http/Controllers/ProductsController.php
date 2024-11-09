<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request) 
    {
        $sortBy = $request->input('sort', 'name');  // Default sorting by 'name'
        $sortOrder = $request->input('order', 'asc');  // Default sorting order 'ascending'
        $productId = $request->input('product_id');  // Get product ID from the request

        $query = Product::query();
        
        // Filter by product ID if provided
        if ($productId) {
            $query->where('id', $productId);
        }

        $products = Product::orderBy($sortBy, $sortOrder)->get();



        // $products = Product::all();
        return view('index', compact('products','productId'));
        

    }
    public function create(Request $request){
        return view('create');
    }
    public function store(Request $request)
{
    //Debugging: check form data if needed
    // dd($request->all());

    $validation = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'product_id' => 'required|string|unique:products,product_id',
    ]);

    $imagePath = null;
    if ($request->has('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images', $imageName, 'public');
    }

    // Redirect or return response
    // return redirect()->back()->with('success', 'Product created successfully.');
    try {
        Product::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    return redirect()->route('products');

}
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('edit', compact('product'));
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'stock' => 'nullable|integer',
    ]);

    $product = Product::findOrFail($id);
    $product->update([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'description' => $request->input('description'),
        'stock' => $request->input('stock'),
    ]);

    return redirect()->route('products')->with('success', 'Product updated successfully.');
}


    public function view(Request $request){

        return view('show');
    }
    public function delete($id){
        $product = Product::findOrFail($id); // Find the product by ID or throw a 404 error
        $product->delete(); // Delete the product

        return redirect()->route('products');
    }

    // public function test(Request $request){
    //     return view('test');
    // }








}
