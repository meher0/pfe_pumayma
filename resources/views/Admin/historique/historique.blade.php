@extends('layouts.admin')

@section('content')



<div class="container">

    @if (session('alert_green'))
    <script>
      toastr.options = {
      "progressBar" : true,
      "closeButton" : true,
    }
      toastr.success("{{ session('alert_green') }}",'Inbanned', {timeOut:12000})
    </script>
    @endif

    @if (session('alert_red'))
    <script>
        toastr.options = {
        "progressBar" : true,
        "closeButton" : true,
        }
        toastr.error("{{ session('alert_red') }}",'Banned', {timeOut:12000})
    </script>
    @endif
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h2 class="text-center" style="color: rgba(255, 0, 0, 0.627);"> Historique </h2>
      </div>
        <div class="table-sites">
            <div class="table-responsive">
                <table  id="history-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nom utilisateur</th>
                            <th>Rôle</th>
                            <th>Action</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                        <tr>
                            <td></td>
                            <td>{{ $history->id }}</td>
                            <td>{{ $history->name }}</td>
                            <td>{{ $history->role }}</td>
                            <td>{{ $history->action }}</td>
                            <td>{{ $history->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
      </div>
    </div>
  </div>
  </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  

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
