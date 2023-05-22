@extends('layouts.admin')

@section('content')
<div class="container">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h2 class="text-center" style="color: rgba(255, 0, 0, 0.627);">قائمة الحسابات الجديدة</h2>

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
    <tr>
    <td>

        <a href="{{route('getUpdateuser',['id'=>$user->id])}}"><span class="btn btn-warning glyphicon-penciel"><i class="fas fa-pencil-alt"></i></span></a>
        <a href="{{url('DeleteUser',$user->id)}}" onclick="return confirm('Are you sure ?');"><span class="btn btn-danger glyphicon-penciel"><i class="fas fa-trash-alt"></i></span></a>
       @if ($user->etat == 1)
       <button title="تفعيل"  class=" btn btn-success glyphicon-penciel" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$user->id}}">
        <i class="fas fa-check"></i>
      </button>
       @else

       @endif

      </td>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="staticBackdropLabel"> تفعيل حساب</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{url('acceptuser')}}" method="post">
@csrf
@method('put')
<div class="modal-body">
<input type="hidden" name="id" value="{{ $user->id }}">
<input type="hidden" name="email" value="{{ $user->email }}">
<input type="hidden" name="name" value="{{ $user->name }}">
{{$user->email}}
هل انت متأكد من تفعيل هذا الحساب ??
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
<button type="submit" class="btn btn-primary">تفعيل</button>
</div>
</form>
</div>
</div>
</div>


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
