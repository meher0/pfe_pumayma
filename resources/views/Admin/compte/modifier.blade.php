@extends('layouts.admin')
@section('content')


               <h2 class="text-center">Modifier Compte</h2>
<form action="{{url('EditUsers/'. $users->id)}}"  method="post">
    @csrf
<input type="hidden" name="_token" value="{{ Session::token() }}">
<input type="hidden" name="id" value="{{ $users->id }}">
<table class="table">
<tr>
<th><div class="form-group"> <label>Nom</label></th>
<div>@if ($errors->has('name'))
          <strong style="color: red;">{{ $errors->first('name') }}</strong>
          @endif</div>
<th><input autocomplete="off" class="form-control" type="text" name="name" value="{{ $users->name}}" required>
</div></th></tr>
<tr>



<tr>
<th><div class="form-group">
<label>email</label></th>
<div>@if ($errors->has('email'))
          <strong style="color: red;">{{ $errors->first('email') }}</strong>
          @endif</div>
<th><input autocomplete="off" type="email" class="form-control" name="email" value="{{ $users->email }}" required>
</div></th></tr>




<th>
<div class="form-group">
<label>Role</label></th>
<div>@if ($errors->has('role'))
          <strong style="color: red;">{{ $errors->first('role') }}</strong>
          @endif</div>
<th>  <select class="input" required name="role" class="form-control" value="{{ $users->rolz }}">
    <option disabled  selected> --choose role --</option>
    <option value="ministere"> ministere</option>
    <option value="invite"> invite</option>
    <option value="visiteur"> visiteur</option>
    <option value="admin"> admin</option>
            </select>
</div></th></tr>

<th>Actions</th>
<th><a href="{{route('ListUser')}}" class="btn btn-default">Annuler</a>
<button type="submit" class="btn btn-warning pull-right">Modifier</button></th></tr>
</form>
</table>



              </div>
            </div>
          </div>
        </div>
@endsection


