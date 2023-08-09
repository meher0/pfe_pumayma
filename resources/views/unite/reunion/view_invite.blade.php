@extends('layouts.unite')
@section('content')



    <div class="row row-cols-1 row-cols-md-3 g-4 ml-5">
        @foreach ($users as $data)
        <div class="card border-primary mb-3 mr-2" style="max-width: 25rem;">
            <div class="card-header bg-transparent border-primary"><b><i class="fa fa-key"></i> {{ $data->id }}</b></div>
            <div class="card-body text-primary">
              <h5 class="card-title"><i class="fa fa-user"></i> {{ $data->name }}</h5>
              <p class="card-text"><i class="fa fa-phone"></i> (+216) {{ $data->phone }}</p>
            </div>
            <div class="card-footer bg-secodary border-primary"><i class="fa fa-envelope"></i> {{ $data->email }}</div>
          </div>
        @endforeach
      </div>



@endsection
