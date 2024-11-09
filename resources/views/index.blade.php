<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
<body>
  <header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

          <li>
            <a href="{{route('products.create')}}" class="nav-link px-2 link-body-emphasis">
              <button class="btn btn-primary">Add Product</button>
            </a>
          </li>
          <li class="nav-link px-2 link-body-emphasis">
              {{-- <input type="search" class="form-control" placeholder="Search by Product ID" aria-label="Search" { request('product_id') }}"> --}}
          </li>
          {{-- shorting drop down start --}}
          <li class="nav-link px-2 link-body-emphasis">
            <form method="GET" action="{{ route('products') }}" class="mb-3">
              <div class="row">
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="product_id" id="product_id" 
                          value="{{ request('product_id') }}" placeholder="Enter Product ID" />
                  </div>
                  
                  <div class="col-lg-4">
                      <label for="sort" class="form-label">Sort By:</label>
                      <select class="form-select" name="sort" id="sort" onchange="this.form.submit()">
                          <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                          <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                      </select>
                  </div>
                  <div class="col-lg-4">
                      <label for="order" class="form-label">Order:</label>
                      <select class="form-select" name="order" id="order" onchange="this.form.submit()">
                          <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                          <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                      </select>
                  </div>
              </div>
          </form>          
          </li>
        </ul>
      </div>
    </div>
  </header>

  <p class="h1 text-center">Product Management System</p>

  {{-- Table starts here  -----------------------------------------}}
<div class="bd-example-snippet bd-code-snippet">
<div class="bd-example m-0 border-0">

    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th scope="col">Image</th>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Created Date</th>
        <th scope="col">Updated Date</th>
        <th scope="col">Operations</th>

      </tr>
      </thead>
      <tbody>
        @foreach($products as $value)
      <tr>
        <td><a href="">{{$value->image}}</a></td>
        <td>{{$value->product_id}}</</td>
        <td>{{$value->name}}</</td>
        <td>{{$value->price}}</</td>
        <td>{{$value->stock}}</</td>
        <td>{{$value->created_at}}</</td>
        <td>{{$value->updated_at}}</</td>

        {{-- operations button field starts here--}}
        <td>
          <a href='{{route('products.edit', ['id'=> $value->id])}}'> 
            <button class="btn btn-primary rounded-pill px-3" onclick="return confirm('Are you sure?')" type="button">Edit</button>
          </a>

          <a href=""><button class="btn btn-success rounded-pill px-3" type="button">View</button></a>

          <a href='{{route('product.delete', ['id'=> $value->id])}}'> 
            <button class="btn btn-danger rounded-pill px-3" onclick="return confirm('Are you sure?')" type="button">Delete</button>
          </a>
        </td>
      </tr>
      @endforeach
      
      </tbody>
    </table>
    
</div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>