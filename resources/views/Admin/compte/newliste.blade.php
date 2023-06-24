@extends('layouts.unite')

@section('content')
<div class="container">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h2 class="text-center" style="color: rgba(255, 0, 0, 0.627);">قائمة الحسابات </h2>
      </div>

        <div class="table-sites">
        <table class="table table-hover">
          <thead>
            <tr>
    <th></th>

    <th>الصفة</th>
    <th>الهاتف</th>
    <th>البريد الالكتروني</th>
    <th>الاسم</th>
    <th> id </th>



    </tr>

    </thead>
    <tbody>
    @foreach( $users as $user)
    <tr>    <td>
                <a href="{{route('getUpdateuser',['id'=>$user->id])}}"><span class="btn btn-warning glyphicon-penciel"><i class="fas fa-pencil-alt"></i></span></a>
                <a href="{{url('DeleteUser',$user->id)}}" onclick="return confirm('Are you sure ?');"><span class="btn btn-danger glyphicon-penciel"><i class="fas fa-trash-alt"></i></span></a>
              </td>


    <td>{{$user->role}}</td>
    <td>{{$user->phone}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->name}}</td>
    <td>{{$user->id}}</td>
    @endforeach

   </tbody>
    </table>
    </div>
      </div>
    </div>
  </div>
  </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>




@endsection
