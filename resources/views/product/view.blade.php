
@extends('layouts/app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card mb-5">
                    <div class="card-header bg-success">
                       List  Product
                    </div>

                    <div class="card-body">
                        @if(session('deletestatus'))
                            <div class="alert alert-danger">
                                {{ session('deletestatus') }}
                            </div>
                        @endif



                        <table class="table">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SL. NO</th>
                                    <th>Product Name</th>
                                    <th>Product Description</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                    <th>Alert  Quantity</th>
                                    <th>Product Image</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                               @forelse ($products as $product)
                                   <tr>
                                       <td>{{ $loop->index+1 }}</td>
                                       <td>{{ $product->product_name }}</td>
                                       <td>{{ $product->product_description }}</td>
                                       <td>{{ $product->product_price }}</td>
                                       <td>{{ $product->product_quantity }}</td>
                                       <td>{{ $product->alert_quantity }}</td>
                                       <td>
                                           <img src="{{ asset('/uploads/product_photos') }}/{{$product->product_image}}" alt="not found" width="50">
                                       </td>
                                       <td>
                                           <div class="btn-group" role="group">

                                              <a href="{{ url('delete/product') }}/{{ $product->id }}" class="btn btn-sm btn-danger">Delete</a>
                                               {{--      <button class="btn btn-danger"  data-toggle="modal"   data-target="#delete_{{$product->id}}">Delete</button>  --}}
                                                          <a href="{{ url('edit/product') }}/{{ $product->id }}" class="btn btn-sm btn-info">Edit</a>

                                                      </div>

                                                  </td>

                                              </tr>
                                              <!-- Modal -->
                                              <!-- Modal -->

                                              @empty
                                              <tr class="text-center text-danger">
                                                  <td colspan="6">No Data Found</td>
                                              </tr>



                                          @endforelse


                                           </tbody>
                                       </table>
                                       {{$products->links() }}

                                   </table>
                               </div>
                           </div>

                           <div class="card">
                               <div class="card-header bg-danger">
                                   Delete  Product
                               </div>

                               <div class="card-body">
{{--                                   @if(session('deletestatus'))
                                        <div class="alert alert-danger">
                                            {{ session('deletestatus') }}
                                        </div>
                                  @endif --}}



                                   <table class="table">
                                       <table class="table table-bordered">
                                           <thead>
                                           <tr>
                                               <th>SL. NO</th>
                                               <th>Product Name</th>
                                               <th>Product Description</th>
                                               <th>Product Price</th>
                                               <th>Product Quantity</th>
                                               <th>Alert  Quantity</th>
                                               <th colspan="2">Action</th>

                                           </tr>
                                           </thead>
                                           <tbody>

                                           @forelse ( $deleted_products as $deleted_product)
                                               <tr>
                                                   <td>{{ $loop->index+1 }}</td>
                                                   <td>{{$deleted_product->product_name }}</td>
                                                   <td>{{ $deleted_product->product_description }}</td>
                                                   <td>{{ $deleted_product->product_price }}</td>
                                                   <td>{{ $deleted_product->alert_quantity }}</td>
                                                   <td>{{ $deleted_product->product_quantity }}</td>
                                                   <td>
                                                       <div class="btn-group" role="group">


                                                           <a href="{{ url('restor/product') }}/{{ $deleted_product->id }}" class="btn btn-sm btn-success">Restor</a>
                                                           <a href="{{ url('force/delete/product') }}/{{ $deleted_product->id }}" class="btn btn-sm btn-danger">Permanent Delete</a>

                                                         {{--
                                                           <button class="btn btn-danger"  data-toggle="modal"   data-target="#delete_{{$product->id}}">Restor</button>
                                                           <a href="{{ url('edit/product') }}/{{ $product->id }}" class="btn btn-sm btn-info">Edit</a>--}}

                                            </div>

                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <!-- Modal -->

                                @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="7">No Data Found</td>
                                    </tr>



                                @endforelse


                                </tbody>
                            </table>
                            {{$products->links() }}

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
              <div class="card">
                  <div class="card-header bg-success">
                       Add Product Form
                  </div>
                  <div class="card-body">

                      @if(session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                      @endif

                    @if($errors->all() )
                              <div class="alert alert-danger">
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach

                              </div>
                     @endif



                      <form action="{{ url('add/product/insert') }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                              <label>Product Name</label>
                              <input type="text" class="form-control"   placeholder="Enter your product name" name="product_name" value="{{ old('product_name') }}">
                          </div>

                          <div class="form-group">
                              <label>Product Description</label>
                              <textarea name="product_description" class="form-control" rows="3" >{{ old('product_description') }}</textarea>
                          </div>

                          <div class="form-group">
                              <label>Product Price</label>
                              <input type="text" class="form-control"   placeholder="Enter your product price" name="product_price" value="{{ old('product_price') }}">
                          </div>

                          <div class="form-group">
                              <label>Product Quantity</label>
                              <input type="text" class="form-control"   placeholder="Enter your product quantity" name="product_quantity" value="{{ old('product_quantity') }}">
                          </div>

                          <div class="form-group">
                              <label>Alert Quantity</label>
                              <input type="text" class="form-control"   placeholder="Enter your product alert" name="alert_quantity" value="{{ old('alert_quantity') }}">
                          </div>

                          <div class="form-group">
                              <label>Product Image</label>
                              <input type="file" class="form-control"     name="product_image">
                          </div>

                          <button type="submit" class="btn btn-primary">Add Product</button>
                      </form>

                  </div>

              </div>

            </div>

        </div>

    </div>


    @endsection
