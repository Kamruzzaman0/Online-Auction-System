@extends('Frontend.Seller.master')
@section('content')
@include('flash')
<button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Add Product
</button>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('seller_product_create')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="catSelector" class="form-label"> Category Name</label>
                        <select name="cate_id" class="form-control" id="catSelector">
                            <option>Choose Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subCatSelector" class="form-label"> Sub Category Name</label>
                        <select name="sub_cate_id" class="form-control" id="subCatSelector">
                            <option>Choose Sub-Category</option>
                            {{--@foreach($sub_categories as $sub_category)
                            <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                            @endforeach--}}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Year</label>
                        <input type="date" class="form-control" name="year" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Minimum Bid</label>
                        <input type="number" class="form-control" name="mini_bid" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Bid End Date</label>
                        <input type="date" class="form-control" name="bid_end" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Bid End Time</label>
                        <input type="time" class="form-control" name="bid_time" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Authentication Image</label>
                        <input type="file" class="form-control" name="auth_image" id="exampleInputEmail2" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<hr>
<table class="table" style="border: 1px solid black;">
    <thead>
        <tr>
            <th scope="col">Serial</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
            <th scope="col">Sub-Category</th>
            <th scope="col">Product Name</th>
            <th scope="col">Description</th>
            <th scope="col">Year</th>
            <th scope="col">Minimum Bid</th>
            <th scope="col">Bid End Date</th>
            <th scope="col">Bid End Time</th>
            <th scope="col">Authentication Image</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $product)
        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>@if($product->image == null)
                <img src="{{asset('/uploads/Product/dummy.webp')}}" height="50" width="50" />
                @else
                <img src="{{asset('/uploads/Product/'.$product->image)}}" height="50" width="50" />
                @endif
            </td>
            <td>{{$product->category->name}}</td>
            <td>{{$product->sub_category->name}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->year}}</td>
            <td>{{$product->mini_bid}}</td>
            <td>{{$product->bid_end}}</td>
            <td>{{$product->bid_time}}</td>
            <td><img src="{{asset('/uploads/Auth.image/'.$product->auth_image)}}" height="50" width="50" /></td>
            <td>
                <a class="btn btn" href="{{route('seller_product_edit', $product->id)}}" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#delcatModal{{$product->id}}">
                    <i class="fa-solid fa-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="delcatModal{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="delcatModal">Are you want to remove ?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <a type="button" class="btn btn-danger" href="{{route('seller_product_delete',$product->id)}}">Confirm</a>
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">NO</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@push('pageJS')
<script>
    $(document).ready(function(){
        $(document).on('change','#catSelector',function(e){
            e.preventDefault();
            let catID = $(this).val();
            let url = "{{route('fatch_subcat',[':cat_id'])}}";

            url = url.replace(':cat_id',catID);
            $('#subCatSelector').html('');
            
            $.ajax({
                url: url,
                type : "GET",
                success: function(data){
                    // console.log(data.subCats);
                    $('#subCatSelector').html('<option selected hidden>Choose Sub-Category</option>');
                    $.each(data.subCats, function(key,value){
                        $('#subCatSelector').append('\
                            <option value = "'+ value.id +'">'+ value.name +'</option>');
                    });

                }
            });
        });
    });
</script>
@endpush