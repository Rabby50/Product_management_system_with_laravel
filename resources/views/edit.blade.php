{{-- @extends('layouts.main')
    @section('main-section')
      @push('title')
        <title>Registration</title>
      @endpush
       --}}
       <!doctype html>
       <html lang="en">
         <head>
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>Bootstrap demo</title>
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
         </head>
         <body>
       {{-- Product edit form start----------------------------- --}}
       <div class="container">
       
           
           <form class="container" method="POST" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
       
               <div class="mb-3">
                   <label class="form-label" for="customFile">Upload Product Image</label>
                   <input type="file" class="form-control" name="image" value="{{ $product->image  }}">
               </div>
       
               <div class="">
                   <label for="validationServer01" class="form-label">Product Id</label>
                   <input type="text" class="form-control is-valid" name="product_id" id="validationServer01" value="{{ $product->product_id }}"  required>
               </div>
               <div class="">
                   <label for="validationServer02" class="form-label">Product Name</label>
                   <input type="text" class="form-control is-valid" name="name" id="validationServer02" value="{{ $product->name }}"  required>
               </div>
       
               <div class="">
                 <label for="validationServer02" class="form-label">Product Details</label>
                 <input type="text" class="form-control is-valid" name="description" id="validationServer02"value="{{ $product->description }}"  required>
             </div>
       
               <div class="">
                 <label for="validationServer02" class="form-label">Price</label>
                 <input type="number" step="0.01" class="form-control is-valid" name="price" id="validationServer02" value="{{ $product->price }}"  required>
             </div>
       
             <div class="">
               <label for="validationServer02" class="form-label">In Stock</label>
               <input type="number" class="form-control is-valid" name="stock"value="{{ $product->stock }}" required>
       
           </div>
               
             <div class="col-12">
               <button class="btn btn-primary" type="submit">Update</button>
             </div>
           </form>
       
           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
         </body>
       </html>