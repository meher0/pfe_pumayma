@extends('layouts.admin')

@section('content')
<div class="container">

    @if (session('alert_green'))
        <script>
        toastr.options = {
        "progressBar" : true,
        "closeButton" : true,
        }
        toastr.success("{{ session('alert_green') }}", {timeOut:12000})
        </script>
    @endif

    @if (session('alert_red'))
    <script>
        toastr.options = {
        "progressBar" : true,
        "closeButton" : true,
        }
        toastr.error("{{ session('alert_red') }}",{timeOut:12000})
    </script>
    @endif
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h2 class="text-center" style="color: rgba(255, 0, 0, 0.627);"> Utilisateurs </h2>
        <button  data-bs-toggle="modal" data-bs-target="#addAccount" class="btn btn-outline-primary" style="float: right;">Nouvelle compte</button>
      </div>

        <div class="table-sites">
        <table id="history-table" class="table table-hover">
          <thead>
            <tr>
    <th></th>

    <th>ID</th>
    <th>Nom</th>
    <th> Email</th>
    <th>Télphone</th>
    <th> Role </th>
    <th> Action </th>



    </tr>

    </thead>
    <tbody>
    @forelse ( $users as $user)
        <tr>
            <td></td>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->role}}</td>
            <td>
                <a href="{{route('showEditAccount',$user->id)}}"><span class="btn  btn-outline-warning glyphicon-penciel"><i class="fas fa-pencil-alt"></i></span></a>
                <a href="{{route('handleDeleteAccount',$user->id)}}" onclick="return confirm('Are you sure ?');"><span class="btn  btn-outline-danger glyphicon-penciel"><i class="fas fa-trash-alt"></i></span></a>
            </td>
        </tr>
    @empty

        <div class="alert  alert-warning">No Data</div>

    @endforelse

   </tbody>
    </table>
    </div>
      </div>
    </div>
  </div>
  </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>






<!-- Modal -->
<div class="modal fade" id="addAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('handleAddAccount') }}">
        @csrf
    <div class="modal-content">
      <div class="modal-header" style="background: #3a60d0;color:white;">
        <h5 class="modal-title" id="staticBackdropLabel">Ajouter utilisateur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Nom et prénom') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-left"> Email </label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-left">Téléphone</label>
                <div class="col-md-6">
                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" required>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


            </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('role') }}</label>
                <div class="col-md-6">
                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="role">
                <option disabled  selected> --choose role --</option>
                <option value="unite"> unite</option>
                <option value="ministere"> ministere</option>
                <option value="invite"> invite</option>
                </select>


                @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>


                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="SUBMIT" class="btn btn-primary">enregister</button>
      </div>
    </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
    $('#history-table').DataTable({
      language: {
        search: "",
        searchPlaceholder: "Rechercher...",
        paginate: {
          previous: "Précédent",
          next: "Suivant"
        }
      },
      lengthMenu: [5, 10, 15, 20],
      "dom": '<"toolbar">frtip',
      "pagingType": "simple_numbers"
    });


  });
</script>
@endsection
