@extends('layouts.admin')
@section('content')



               <h2 class="text-center" style="color: rgba(255, 0, 0, 0.627);">{{ $entreprises->nom }}تغير معطيات مؤسسة   </h2>
               <div class="container">

<form action="{{url('EditEntreprises/'. $entreprises->id)}}"  method="post">
    @csrf
    <div class="row">

<input type="hidden" name="_token" value="{{ Session::token() }}">
<input type="hidden" name="id" value="{{ $entreprises->id }}">

<table class="table">
<tr>

<div>@if ($errors->has('nom'))
          <strong style="color: red;">{{ $errors->first('nom') }}</strong>
          @endif</div>
<th><input autocomplete="off" class="form-control" type="text" name="nom" value="{{ $entreprises->nom }}" required>
</div></th>
<th><div class="form-group"> <label>اسم المؤسسة</label></th></tr>
<tr>

<div>@if ($errors->has('directeur'))
          <strong style="color: red;">{{ $errors->first('directeur') }}</strong>
          @endif</div>
<th><input autocomplete="off" type="text" class="form-control" name="directeur" value="{{ $entreprises->directeur }}" required>
</div></th>
<th><div class="form-group">
  <label>مدير المؤسسة</label></th></tr>


<tr>

<div>@if ($errors->has('email'))
          <strong style="color: red;">{{ $errors->first('email') }}</strong>
          @endif</div>
<th><input autocomplete="off" type="email" class="form-control" name="email" value="{{ $entreprises->email }}" required>
</div></th>
<th><div class="form-group">
  <label>البريد الالكتروني</label></th></tr>
<tr>
<div>@if ($errors->has('telephone'))
          <strong style="color: red;">{{ $errors->first('telephone') }}</strong>
          @endif</div>
<th><input type="telephone" class="form-control" name="telephone" value="{{ $entreprises->telephone }}" required>
</div></th>
<th>
  <div class="form-group">
  <label>الهاتف</label></th></tr>




<div>@if ($errors->has('adresse'))
          <strong style="color: red;">{{ $errors->first('adresse') }}</strong>
          @endif</div>
<th><input type="adresse" class="form-control" name="adresse" value="{{ $entreprises->adresse }}" required>
</div></th>
<th>
  <div class="form-group">
  <label>العنوان</label></th></tr>


<th><a href="{{route('ListEntrepise')}}" class="btn btn-secondary">خروج</a>
<button type="submit" class="btn btn-warning pull-right">تسجيل</button></th></tr>
</form>
</table>



              </div>
            </div>

@endsection


