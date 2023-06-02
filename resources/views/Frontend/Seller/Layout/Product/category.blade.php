@extends('Frontend.Seller.master')
@section('content')
@include('flash')


<!-- Button trigger modal -->
<!-- Button trigger modal -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
Add category
</button>

<!-- Modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <form action="{{route('seller_category_create')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" id="exampleInputPassword1">
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
<table class="table">
    <thead>
        <tr>
            <th scope="col">Serial</th>
            <th scope="col">Category Name</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>

        </tr>
        @foreach($categories as $key => $category)
        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>
            <td>
                <a class="btn btn" href="{{route('seller_category_edit',$category->id)}}" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#delcatModal{{$category->id}}">
                    <i class="fa-solid fa-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="delcatModal{{$category->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="delcatModal">Are you want to remove ?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <a type="button" class="btn btn-danger" href="{{route('seller_category_delete', $category->id)}}">Confirm</a>
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">NO</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </thead>

    </tbody>
</table>

@endsection