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

            <table class="table  table-bordered" id="dataTable" style="border: solid 1px #4e73df">
                <thead style="background: #4e73df;color:white">
                <tr>
                    <th>Titre</th>
                    <th>Reunion ID</th>
                    <th>Date fin désicion</th>
                    <th>Document</th>
                    <th>Rappel</th>
                    <th>Status</th>
                    <th>Personne responsable</th>
                    <th>action</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td> {{$data->title}} </td>
                        <td> {{$data->reunion_id}} </td>
                        <td> {{$data->date_end_decision}} </td>
                        <td> <a href="{{ route('handleDownloadDecision',$data->file) }}"> <i class="fa fa-file-pdf"></i> télecharger </a> </td>
                        <td>
                            @php
                                $remainingDays = now()->diffInDays($data->date_end_decision);
                            @endphp
                            @if(now() < $data->date_end_decision)
                                @if($remainingDays > 5)
                                    <button class="btn btn-success disabled btn-sm">Encore {{ $remainingDays }} jours</button>
                                @elseif($remainingDays > 3)
                                    <button class="btn btn-primary disabled btn-sm">Encore {{ $remainingDays }} jours</button>
                                @elseif($remainingDays >= 0)
                                    @if ($remainingDays == 0)
                                        <button class="btn btn-danger disabled btn-sm">Aujourd hui</button>
                                    @else
                                        <button class="btn btn-warning disabled btn-sm">Encore {{ $remainingDays }} jours</button>
                                    @endif
                                @endif
                            @else
                                    <button class="btn btn-secondary btn-sm">Date passée</button>
                            @endif
                        </td>
                        <td>

                            @if($data->status== 3)
                                <select>
                                    <option selected readonly>la mise en oeuvre</option>
                                </select>
                            @endif

                            @if($data->status== 2)
                                    <select>
                                        <option selected readonly>Activé</option>
                                    </select>
                            @endif

                            @if($data->status== 1)
                                    <select>
                                        <option selected readonly>En cours exécution</option>
                                    </select>
                            @endif

                            @if($data->status== 0)
                                    <select>
                                        <option selected readonly>Aucune réponse</option>
                                    </select>
                            @endif
                        </td>
                        <td> {{ $data->user->name }} <i data-bs-toggle="modal" data-bs-target="#exampleModal{{ $data->id }}" class="fa fa-eye"> </td>
                        <td>
                            <a href="{{ route('handleUniteDeleteDecision',$data->id) }}"  onclick="return confirm('Are you sure ?');"   class="btn btn-outline-danger"><i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Information sur responsable</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="{{ $data->user->name }}" readonly>
                                <label for="floatingInput">Nom</label>
                              </div>
                              <div class="form-floating">
                                <input type="text" class="form-control" id="email" value="{{ $data->user->email }}" readonly>
                                <label for="email">Email</label>
                              </div> <br>
                              <div class="form-floating">
                                <input type="text" class="form-control" id="floatingPassword" value="{{ $data->user->phone }}" readonly>
                                <label for="floatingPassword">Téléphone</label>
                              </div>
                        </form>
                    </div>

                    </div>
                </div>
                </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->

@endsection
