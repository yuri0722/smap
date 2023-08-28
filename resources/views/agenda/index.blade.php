@extends('layouts.bemestar', ["active"=>"agenda"])

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid' ],
                events: [
                    {
                        title: 'Evento 1',
                        start: '2023-08-25T10:00:00',
                        end: '2023-08-25T12:00:00'
                    },
                    {
                        title: 'Evento 2',
                        start: '2023-08-26T14:00:00',
                        end: '2023-08-26T16:00:00'
                    }
                ]
            });

            calendar.render();
        });
    </script>
@endsection
