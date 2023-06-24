@extends('layouts.admin')
@section('content')
<div class="container">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h2 class="text-center" style="color: rgba(255, 0, 0, 0.627);">   قائمةالاجتماعات</h2>
      </div>
    
          @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
          @endif

        <div class="table-sites">
        <table class="table table-hover">
          <thead> <tr>
           
              <th>title</th>
              <th>objectif</th>
              <th>type</th>
              <th>lieu</th>
              <th>start</th>
              <th>fin</th>
              <th>document</th>
              <th>nombre des invites</th>
              <th>action</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($datas as $data)
                <tr>
                   
                    <td> {{$data->title}} </td>
                    <td> {{$data->objectif}} </td>
                    <td> {{$data->type}} </td>
                    <td> {{$data->lieu}} </td>
                    <td> {{$data->start}} </td>
                    <td> {{$data->end}} </td>
                    <td> {{$data->document}} </td>
                    <td> {{$data->invites->count()}} </td>
                    <td> 
                        <a title="view invite"   href="{{url('view_invite_reunion',$data->id)}}"><span class="btn btn-dark btn-sm glyphicon-send">view invite</i></span></a>
                        <a title="donwload"      href="{{url('download',$data->document)}}"><span class="btn btn-success  glyphicon-send"><i class="fas fa-download"></i></span></a>
                        <a title="view document" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $data->id }}" href=""><span class="btn btn-warning glyphicon-send"><i class="fas fa-eye"></i></span></a>
                        <a title="supprimer"     href="{{url('delete_reunion',$data->id)}}"><span class="btn btn-danger glyphicon-send"><i class="fas fa-trash"></i></span></a>
                      
                      </td>

                </tr>



<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title " id="exampleModalLabel">View document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <iframe style="width: 100%;height:100%;" src="uploads/documents/{{ $data->document }}" frameborder="0"></iframe>
      </div>
     
    </div>
  </div>
</div>
            @endforeach


           </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
