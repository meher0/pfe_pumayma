// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "lengthMenu": [5, 10, 15, 20], // Options de pagination
    "pageLength": 5, // Nombre de lignes par page par défaut
    "language": {
      "search": "Recherche :", // Texte de recherche
      "paginate": {
        "first": "Premier",
        "last": "Dernier",
        "next": "Suivant",
        "previous": "Précédent"
      }
    }
  });

});
