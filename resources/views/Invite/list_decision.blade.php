@extends('layouts.invite')
   @section('content')



 <!-- DATA TABLE-->
 <section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">consulter des reunions</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                       <div class="row">
                        <div class="col-md-10">
                            <input type="search"  class="form-control" name="q" id="q" placeholder="search...">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-dark">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                       </div>
                     </div>

                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table " id="dataTable" style="border: solid 1px #2a2b2c">
                        <thead style="background: #2a2a2c;color:white">
                        <tr>
                            <th>Titre</th>
                            <th>Reunion ID</th>
                            <th>Date fin désicion</th>
                            <th>Document</th>
                            <th>Rappel</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td> {{$data->title}} </td>
                                <td> {{$data->reunion_id}} </td>
                                <td> {{$data->date_end_decision}} </td>
                                <td> <a href="{{ route('handleInviteDownload',$data->file) }}"> <i class="fa fa-file-pdf"></i> télecharger </a> </td>
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
                                                <button class="btn btn-danger disabled btn-sm">Aujourd'hui</button>
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
                                                <option selected readonly>En cours d'exécution</option>
                                            </select>
                                    @endif

                                    @if($data->status== 0)
                                            <select>
                                                <option selected readonly>Aucune réponse</option>
                                            </select>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('handleUniteDeleteDecision',$data->id) }}" data-toggle="modal" data-target="#editModal{{ $data->id }}" class="btn btn-outline-primary"><i class="fa fa-pen"></i> </a>
                                </td>
                            </tr>


                            <!-- Modal -->
                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                      <div class="modal-body">
                                            <form method="post" action="{{route('handleInviteUpdateDecision',$data->id)}}">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="titre" class="form-label">Titre</label>
                                                        <input type="text" class="form-control" name="title" id="titre" value="{{ $data->title }}" aria-describedby="emailHelp" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date_fin" class="form-label">Date fin décision</label>
                                                        <input type="datetime-local" name="date_fin_decision" class="form-control" value="{{ $data->date_end_decision }}"  readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Date fin décision</label>
                                                       <select class="form-control" name="status" id="status">
                                                        <option value="0" @if($data->status == 0) selected @endif>Aucune réponse</option>
                                                        <option value="1" @if($data->status == 1) selected @endif>En cours exécution</option>
                                                        <option value="2" @if($data->status == 2) selected @endif>Activé</option>
                                                        <option value="3" @if($data->status == 3) selected @endif>la mise en oeuvre</option>
                                                       </select>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermé</button>
                                                    <button type="submit" class="btn btn-primary">Change</button>
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
        </div>
    </div>
</section>
<!-- END DATA TABLE-->


   @endsection
