@extends('layouts.unite')

@section('content')
<div class="container">
    <div id="calendar"></div>
</div>

<style>
    /* Style pour le calendrier */
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Style pour les jours passés */
    .fc-past {
        background-color: #f2f2f2; /* Couleur de fond des jours passés */
        pointer-events: none; /* Désactiver l'interaction avec les jours passés */
        cursor: not-allowed; /* Curseur "non autorisé" pour les jours passés */
    }

    /* Style pour les jours futurs */
    .fc-future {
        pointer-events: none; /* Désactiver la sélection des jours futurs */
        cursor: not-allowed; /* Curseur "non autorisé" pour les jours futurs */
    }
</style>

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var today = new Date(); // Obtenez la date actuelle

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        validRange: {
            start: today, // Commence à partir d'aujourd'hui
        },
        events: '/calender',
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');
            console.log(title);

            if (title) {
                var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                $.ajax({
                    url: "/calender/action",
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    success: function (data) {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Created Successfully");
                    }
                });
            }
        },
        editable: true,
        eventResize: function (event, delta) {
            // Votre code pour redimensionner les événements
        },
        eventDrop: function (event, delta) {
            // Votre code pour déplacer les événements
        },
        eventClick: function (event) {
            if (confirm("Are you sure you want to remove it?")) {
                var id = event.id;
                $.ajax({
                    url: "/calender/action",
                    type: "POST",
                    data: {
                        id: id,
                        type: "delete"
                    },
                    success: function (response) {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Deleted Successfully");
                    }
                });
            }
        },
        dayRender: function (date, cell) {
            if (date.isBefore(today, 'day')) {
                cell.addClass('fc-past');
            } else {
                cell.addClass('fc-future'); // Applique la classe pour les jours futurs
            }
        }
    });
});
</script>
@endsection
