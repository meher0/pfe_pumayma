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
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>objectif</th>
                                <th>type</th>
                                <th>lieu</th>
                                <th>heur debut</th>
                                <th>heur fin</th>
                                <th>document</th>
                                <th>action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)

                                @php
                                    $startDate = Carbon\Carbon::parse($data->start);
                                    $now = Carbon\Carbon::parse(Carbon\Carbon::now());
                                    $diff = $startDate->diffInDays($now);

                                @endphp

                                <td>{{ $data->title }}</td>
                                <td>{{ $data->objectif }}</td>
                                <td>{{ $data->type }}</td>
                                <td>{{ $data->lieu }}</td>
                                <td>{{ $data->start }}</td>
                                <td>{{ $data->end }}</td>
                                <td>{{ $data->document }}</td>

                                <td>
                                    @if ($diff > 1)
                                        <button class="btn btn-success" disabled><i class="fa fa-download"></i></button>
                                        <button class="btn btn-warning"disabled><i class="fa fa-eye"></i></button>
                                    @else
                                        <a class="btn btn-success" href="{{ route('download', ['file' => $data->document]) }}"><i class="fa fa-download"></i></a>
                                        <button data-toggle="modal" data-target="#exampleModal{{ $data->id }}"  class="btn btn-warning"><i class="fa fa-eye"></i></button>
                                    @endif
                                </td>

                            </tbody>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $data->id }}"  data-keyboard="false" tabindex="-1" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                    <h5 class="modal-title " id="exampleModalLabel">View document</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <iframe style="width: 100%;height:600px;" src="/uploads/documents/{{ $data->document }}" frameborder="0"></iframe>
                                    </div>

                                </div>
                                </div>
                            </div>
                   @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END DATA TABLE-->


   @endsection
