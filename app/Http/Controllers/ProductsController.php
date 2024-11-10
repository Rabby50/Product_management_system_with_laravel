<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request) 
    {
        $query = Product::query();

            // Apply search filter if requested
            if ($request->has('search')) {
                $query->where('product_id', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            }

        $sortBy = $request->input('sort', 'name'); 
        $sortOrder = $request->input('order', 'asc');  
        $productId = $request->input('product_id'); 

        // $query = Product::query();
        
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
        $image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName; 
    }

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
            'product_id' => 'nullable|string',
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


    public function view($id){
        $product = Product::findOrFail($id);
        return view('show', compact('product'));
    }
    public function delete($id){
        $product = Product::findOrFail($id); 
        $product->delete(); 

        return redirect()->route('products');
    }


}
