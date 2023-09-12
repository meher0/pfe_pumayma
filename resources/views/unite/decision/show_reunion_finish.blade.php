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
    @if ($errors->any())
        <script>
            toastr.options = {
                "progressBar" : true,
                "closeButton" : true,
            }
            @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}", {timeOut:10000})
            @endforeach
        </script>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des réunions Termineé</h6>
        </div>
        <div class="card-body">

            <table class="table  table-bordered table-hover" id="dataTable" style="border: solid 1px #4e73df">
                <thead style="background: #4e73df;color:white">
                <tr>
                    <th>Title</th>
                    <th>objectif</th>
                    <th>type</th>
                    <th>lieu</th>
                    <th>start</th>
                    <th>fin</th>
                    <th>document</th>
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
                        <td>
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#modalAdd{{$data->id}}" class="btn btn-primary btn-sm">ajouté décision </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalAdd{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-primary">
                                    <h5 class="modal-title  text-white" id="exampleModalLabel">Ajouté Décision</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="{{route('handleAddDecision')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="titre" class="form-label">Titre</label>
                                            <input type="hidden" name="reunion_id" value="{{$data->id}}">
                                            <input type="text" class="form-control" name="title" id="titre" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="date_fin" class="form-label">Date fin décision</label>
                                            <input type="datetime-local" name="date_fin_decision" class="form-control" id="date_fin">
                                        </div>
                                        <div class="mb-3">
                                            <label for="doct" class="form-label">document</label>
                                            <input type="file" name="file" class="form-control" id="doct">
                                        </div>
                                        <div class="mb-3">
                                            <label for="person" class="form-label">personne mise en œuvre</label>
                                            <select class="form-control" id="person" name="invite">
                                                <option disabled selected>--choisir invites--</option>
                                                @foreach ($data->invites as $invite)
                                                    <option value="{{$invite->user->id}}">{{$invite->user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermé</button>
                                        <button type="submit" class="btn btn-primary">Ajouté</button>
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

    <!-- Modal -->
<script>
    var currentDate = new Date();
    var minDate = currentDate.toISOString().slice(0, 16); // Format: "YYYY-MM-DDTHH:mm"
    document.getElementById("date_fin").min = minDate;
</script>
@endsection
