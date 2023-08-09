@extends('layouts.unite')
@section('content')
<div class="container">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h2 class="text-center" style="color: rgba(255, 0, 0, 0.627);">   قائمةالمؤسسات</h2>
      </div>

          @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
          @endif

        <div class="table-sites">
            <table class="table  table-bordered table-hover" id="dataTable" style="border: solid 1px #4e73df">
                <thead style="background: #4e73df;color:white">
                <tr>
            <th></th>
              <th>title</th>
              <th>debut</th>
              <th>fin</th>
              <th>id</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($planifies as $planifier)
            <tr>
                <td>
                    <a href="{{url('detailler_reunion',$planifier->id)}}"><span class="btn btn-success glyphicon-send"><i class="fas fa-paper-plane"></i></span></a>
                    <a href="{{url('delete_planifier',$planifier->id)}}" onclick="return confirm('Are you sure ?');"><span class="btn btn-danger glyphicon-penciel"><i class="fas fa-trash-alt"></i></span></a>
                  </td>

              <td> {{$planifier->title}} </td>
              <td> {{$planifier->start}} </td>
              <td> {{$planifier->end}} </td>
              <td> {{$planifier->id}} </td>

            </tr>




{{--
  <!-- Modal -->
  <div class="modal fade" id="addreunion{{ $planifier->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ url('add_reunion') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control" name="title" readonly value="{{ $planifier->title }}" >
            </div> <br>

        </div>
        <div class="row">
            <div class="col-md-6">
                <input type="datetime" class="form-control" name="start" readonly value="{{ $planifier->start }}" >
            </div>
            <div class="col-md-6">
                <input type="datetime"  class="form-control" name="end" readonly value="{{ $planifier->end }}" >
            </div>
        </div> <br>

        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="type" placeholder="type" >
            </div>
            <div class="col-md-6">
                <input type="test"  class="form-control" name="objectif" placeholder="objectif" >
            </div>
        </div>


        <div class="row">
            <div class="colo-md-12">
                <input type="text" name="lieu" class="form-control" placeholder="lieu">
            </div>
        </div>

        <a  data-bs-toggle="modal" data-bs-target="#model2"><span class="btn btn-success glyphicon-send"><i class="fas fa-paper-plane"></i></span></a>
        </form>
        </div>

      </div>
    </div>
  </div>
 --}}


  @endforeach


</tbody>
</table>
</div>
      </div>
    </div>
  </div>
  </div>
  @endsection
