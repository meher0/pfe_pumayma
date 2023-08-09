@extends('layouts.unite')
@section('content')

    @if (session('alert_green'))
        <script>
            toastr.options = {
            "progressBar" : true,
            "closeButton" : true,
            }
            toastr.success("{{ session('alert_green') }}",'Inbanned', {timeOut:10000})
        </script>
    @endif

    @if (session('alert_red'))
        <script>
            toastr.options = {
            "progressBar" : true,
            "closeButton" : true,
            }
            toastr.error("{{ session('alert_red') }}",'Banned', {timeOut:10000})
        </script>
    @endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des réunions</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table  table-bordered table-hover" id="dataTable" style="border: solid 1px #4e73df">
            <thead style="background: #4e73df;color:white">
                <tr>
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
                        <td> {{$data->start_date}} </td>
                        <td> {{$data->end_date}} </td>
                        <td> {{$data->document}} </td>
                        <td> {{$data->invites->count()}} </td>
                        <td>
                            <div class="d-flex">
                                <div class="dropdown me-1">
                                    <i style="cursor: pointer;" class="fas fa-ellipsis-v" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20"></i>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                    <li><a class="dropdown-item" href="{{--  {{url('view_invite_reunion',$data->id)}}  --}}">view document</a></li>
                                    <li><a class="dropdown-item" href="{{url('view_invite_reunion',$data->id)}}">view invite</a></li>
                                    @if ($data->end_date < now())
                                    <li><a class="dropdown-item" href="{{route('showReunionFinish',$data->id)}}">Ajouter procés verbal</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{url('delete_reunion',$data->id)}}">supprimer reunion</a></li>
                                </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
        </div>
    </div>
</div>
@endsection
