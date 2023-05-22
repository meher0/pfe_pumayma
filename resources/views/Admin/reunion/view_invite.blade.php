@extends('layouts.admin')
@section('content')


    
    <div class="row row-cols-1 row-cols-md-3 g-4 ml-5">
        @foreach ($users as $data)
        <div class="card border-success mb-3" style="max-width: 25rem;">
            <div class="card-header bg-transparent border-success"><b>ID: {{ $data->id }}</b></div>
            <div class="card-body text-success">
              <h5 class="card-title">{{ $data->name }}</h5>
              <p class="card-text">{{ $data->phone }}</p>
            </div>
            <div class="card-footer bg-transparent border-success">{{ $data->email }}</div>
          </div>
        @endforeach
      </div>
    

    
@endsection