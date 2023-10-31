@extends('layouts.unite')
@section('content')

    @if (session('alert_green'))
        <script>
            toastr.options = {
            "progressBar" : true,
            "closeButton" : true,
            }
            toastr.success("{{ session('alert_green') }}", {timeOut:10000})
        </script>
    @endif

    @if (session('alert_red'))
        <script>
            toastr.options = {
            "progressBar" : true,
            "closeButton" : true,
            }
            toastr.error("{{ session('alert_red') }}", {timeOut:10000})
        </script>
    @endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des réunions</h6>
    </div>
    <div class="card-body">

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
                        <td>
                            @if($data->type == '0')
                                <button class="btn btn-secondary btn-sm"> Réunions de travail</button>
                            @endif
                            @if($data->type == '1')
                                <button class="btn btn-secondary btn-sm">Réunions de formation</button>
                            @endif
                            @if($data->type == '2')
                                <button  class="btn btn-secondary btn-sm">Réunions ministérielle</button>
                            @endif

                        </td>
                        <td> {{$data->lieu}} </td>
                        <td> {{$data->planifier->start}} </td>
                        <td> {{$data->planifier->end}} </td>
                        <td> {{$data->document}} </td>
                        <td> {{$data->invites->count()}} </td>
                        <td>
                            <div class="d-flex">
                                <div class="dropdown me-1">
                                    <i style="cursor: pointer;" class="fas fa-ellipsis-v" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20"></i>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                    <li><a class="dropdown-item" href="  {{route('showUniteFile',$data->id)}}" >View document</a></li>
                                    <li><a class="dropdown-item" href="{{url('view_invite_reunion',$data->id)}}">View invite</a></li>
                                    @if ($data->planifier->start > now())
                                        <li><a data-toggle="modal" data-target="#reportModal{{$data->id}}" class="dropdown-item">Réporter reunion</a></li>
                                    @endif
                                    @if ($data->planifier->end < now())
                                        <li><a class="dropdown-item" href="{{route('showReunionFinish',$data->id)}}">Ajouter procés verbal</a></li>
                                    @endif
                                    <li><a class="dropdown-item" onclick="return confirm('Are you sure ?');" href="{{url('delete_reunion',$data->id)}}">Annuler réunion</a></li>
                                </ul>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="reportModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #4e73df;">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Réporter un réunion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('handleReporterReunion',$data->id)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="planifier_id" value="{{$data->planifier->id}}">
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input type="datetime-local" class="form-control" name="start" id="floatingInput" value="{{$data->planifier->start}}" placeholder="name@example.com">
                                            <label for="floatingInput">Date début de réunion</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="datetime-local" class="form-control" name="end" id="floatingPassword" value="{{$data->planifier->end}}" placeholder="Password">
                                            <label for="floatingPassword">Date fin de réunion</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
         </table>
    </div>
</div>
@endsection
