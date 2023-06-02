@extends('Backend.master')
@section('content')

@include('flash')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Image</th>
      <th scope="col">Phone</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $key => $user)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->address}}</td>
      <td>
        @if($user->image == null)
        <img src="{{asset('/uploads/Profile/dummy.webp')}}" height="50" width="50" />
        @else
        <img src="{{asset('/uploads/Profile/'.$user->image)}}" height="50" width="50" />
        @endif
      </td>
      <td>{{$user->phone}}</td>
      <td>
        <a class="btn btn" href="{{route('admin_userlist_edit', $user->id)}}" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
        <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#delcatModal{{$user->id}}">
          <i class="fa-solid fa-trash"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="delcatModal{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="delcatModal">Are you want to remove ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <a type="button" class="btn btn-danger" href="{{route('admin_userlist_delete', $user->id)}}">Confirm</a>
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