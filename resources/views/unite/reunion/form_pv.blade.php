@extends('layouts.unite')
@section('content')
<div class="card ml-3 mr-3 border-primary">
    <div class="card-header text-white" style="background: #4e73df;">
      Ajouter un procés verbal
    </div>
    <div class="card-body">
        <form class="row g-3 needs-validation" novalidate method="post" action="{{ route('HandleAddProcesVerbal',$data->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
              <label for="title" class="form-label">Titre</label>
              <input type="hidden" name="reunion_id" value="{{ $data->id }}">
              <input type="text" class="form-control" id="title" value="{{ $data->title }}" readonly>
            </div>
            <div class="col-md-4">
              <label for="objectif" class="form-label">Objectif</label>
              <input type="text" class="form-control" id="objectif" value="{{ $data->objectif }}" readonly>
            </div>
            <div class="col-md-4">
              <label for="type" class="form-label">Type</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="type" aria-describedby="inputGroupPrepend" value="{{ $data->type }}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <label for="start" class="form-label">Date debut</label>
              <input type="text" class="form-control" id="start" value="{{ $data->planifier->start }}" readonly>
            </div>
            <div class="col-md-4">
              <label for="end" class="form-label">Date fin</label>
              <input type="text" class="form-control" id="end" value="{{ $data->planifier->end }}" readonly>
            </div>
            <div class="col-md-4">
              <label for="lieu" class="form-label">Lieu</label>
              <input type="text" class="form-control" id="lieu" value="{{ $data->lieu }}" readonly>
            </div>

            <div class="col-12">
                <div class="input-group mb-3">
                    <input type="file" name="document" class="form-control" id="inputGroupFile01">
                  </div>
            </div>

            <div class="col-12">
              <button type="submit" class="btn text-white" style="background: #4e73df;" type="submit">Envoyer</button>
            </div>
          </form>

    </div>
  </div>
@endsection
