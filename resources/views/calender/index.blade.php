@extends('layouts.app')

@section('content')

    <div class="container">
        <div id='top'>
            <div class='left'>

                <div id='theme-system-selector' class='selector'>

                    <select hidden>

                        <option value='bootstrap' selected>Bootstrap 4</option>
                        <option value='standard'>unthemed</option>

                    </select>
                </div>

                <div data-theme-system="bootstrap" class='selector' style='display:none'>


                    <select hidden>
                        <option value='' selected>Default</option>
                        <option value='cerulean'>Cerulean</option>
                        <option value='cosmo'>Cosmo</option>
                        <option value='cyborg'>Cyborg</option>
                        <option value='darkly'>Darkly</option>
                        <option value='flatly'>Flatly</option>
                        <option value='journal'>Journal</option>
                        <option value='litera'>Litera</option>
                        <option value='lumen'>Lumen</option>
                        <option value='lux'>Lux</option>
                        <option value='materia'>Materia</option>
                        <option value='minty'>Minty</option>
                        <option value='pulse'>Pulse</option>
                        <option value='sandstone'>Sandstone</option>
                        <option value='simplex'>Simplex</option>
                        <option value='sketchy'>Sketchy</option>
                        <option value='slate'>Slate</option>
                        <option value='solar'>Solar</option>
                        <option value='spacelab'>Spacelab</option>
                        <option value='superhero'>Superhero</option>
                        <option value='united'>United</option>
                        <option value='yeti'>Yeti</option>
                    </select>
                </div>

                <span id='loading' style='display:none'>loading theme...</span>

            </div>

            <div class='right'>
                <span class='credits' data-credit-id='bootstrap-standard' style='display:none'>
                </span>
                <span class='credits' data-credit-id='bootstrap-custom' style='display:none'>
                </span>
            </div>

            <div class='clear'></div>
        </div>

        <div class="container">
            <div id='calendar'></div>
        </div>
    </div>
    {{-- <buttonsdar"></div> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" /> --}}

    <!-- If you use the default popups, use this. -->
    {{-- <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css" />
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css" />
    <script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
    <script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>
    <script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>
    <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar;

            initThemeChooser({

                init: function(themeSystem) {
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        themeSystem: 'standard',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                        },
                        initialDate: Date.now(),
                        weekNumbers: true,
                        navLinks: true, // can click day/week names to navigate views
                        editable: false,
                        selectable: true,
                        eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc) {
                          console.log(event, dayDelta, minuteDelta, allDay, revertFunc);

                        },
                        eventClick: function(arg) {
                            if (confirm('Are you sure you want to delete this event?')) {
                                arg.event.remove()
                            }
                        },

                        select: async function(arg) {
                            var title = prompt('Event Title:');
                            if (title) {
                                let fd = new FormData()
                                fd.append('data', JSON.stringify({
                                    title: title,
                                    start: arg.start,
                                    end: arg.end,
                                    allDay: arg.allDay
                                }))
                                let object = {
                                    title: title,
                                    start: arg.start,
                                    end: arg.end,
                                    allDay: arg.allDay
                                }
                                await fetch('/calender', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        body: fd
                                    })
                                    .then(
                                        res => res.json()
                                    ).then(data => {
                                        console.log(
                                            data, 'FROM Calender'
                                        );
                                    })
                                    .catch(err => {
                                        console.log(err);
                                    })
                                calendar.addEvent(object)
                            }
                            calendar.unselect()
                        },
                        nowIndicator: true,
                        dayMaxEvents: true, // allow "more" link when too many events
                        // showNonCurrentDates: false,
                        events: {!! $event !!}
                    });
                    calendar.render();


                },

                change: function(themeSystem) {
                    calendar.setOption('themeSystem', themeSystem);
                }

            });

        });
    </script>
@endsection
