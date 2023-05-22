@extends('layouts.admin')
@section('content')
<div class="container">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h2 class="text-center" style="color: rgba(255, 0, 0, 0.627);">   قائمةالمؤسسات</h2>
      </div>
      <a href="{{ route('getAddEntreprise') }}" class="btn btn-success">اضافة مؤسسة</a>

        <div class="table-sites">
        <table class="table table-hover">
          <thead> <tr>
            <th></th>
   <th>الهاتف</th>
   <th>مدير المؤسسة</th>
   <th>البريد الالكتروني</th>
   <th>العنوان</th>
   <th>الاسم</th>
   <th>ID</th>






            </tr>
          </thead>

          <tbody>
            @foreach ($entreprises as $entreprise)
            <tr>
                <td>
                    <a href="{{route('getUpdate',['id'=>$entreprise->id])}}"><span class="btn btn-warning glyphicon-penciel"><i class="fas fa-pencil-alt"></i></span></a>
                    <a href="{{url('DeleteEntreprise',$entreprise->id)}}" onclick="return confirm('Are you sure ?');"><span class="btn btn-danger glyphicon-penciel"><i class="fas fa-trash-alt"></i></span></a>
                  </td>

     <td  > {{$entreprise->telephone}} </td>
              <td  > {{$entreprise->directeur}} </td>


              <td  > {{$entreprise->email}} </td>
              <td  > {{$entreprise->adresse}} </td>
              <td  > {{$entreprise->nom}} </td>
  <td  > {{$entreprise->id}} </td>





            </tr>
            @endforeach


          </tbody>
        </table>
</div>
      </div>
    </div>
  </div>
  </div>
  @endsection
