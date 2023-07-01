@extends('layouts.unite')
@section('content')

<div class="card">
<h2 class="text-center">Modifier Compte</h2>

  <form action="{{route('handleUpdateAccount', $users->id)}}"  method="post">
    @csrf
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <input type="hidden" name="id" value="{{ $users->id }}">
        <table class="table">
        <tr>
            <th><div class="form-group"> <label>Nom</label></th>
            <div>
            @if ($errors->has('name'))
                    <strong style="color: red;">{{ $errors->first('name') }}</strong>
            @endif
            </div>
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
        <label>Role</label>
        </th>
        <div>
            @if ($errors->has('role'))
                    <strong style="color: red;">{{ $errors->first('role') }}</strong>
             @endif
       </div>
        <th>
             <select   name="role" class="form-control" required>
                <option value="ministere" {{ $users->role == 'ministere' ? 'selected' : '' }}>ministere </option>
                <option value="invite"    {{ $users->role == 'invite' ? 'selected' : '' }}>invite </option>
                <option value="visiteur"  {{ $users->role == 'visiteur' ? 'selected' : '' }}>visiteur </option>
                <option value="unite"     {{ $users->role == 'unite' ? 'selected' : '' }}>unite </option>
                <option value="admin"     {{ $users->role == 'admin' ? 'selected' : '' }}>admin </option>
            </select>
        </div></th></tr>

        <th>Actions</th>
        <th><a href="{{url('list')}}"  class="btn btn-outline-secondary"> Annuler </a>
        <button type="submit" class="btn btn-outline-primary"> Modifier </button></th></tr>
        </table>
  </form>

@endsection


