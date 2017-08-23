<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />

<link href="{{asset('plugins/fullcalendar/fullcalendar.min.css')}}" rel='stylesheet' />
<link href="{{asset('plugins/fullcalendar/fullcalendar.print.min.css')}}" rel='stylesheet' media='print' />
<script src="{{asset('plugins/fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar/lib/jquery.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar/locale/es.js')}}"></script>


<script>

    $(document).ready(function() {
        var initialLocaleCode='es';
        var event=[];
        var order=<?php echo json_encode($orders);?>;
        
        for(var i=0;i<order.length;i++){
            if (order[i].status=='pendiente'){
                event.push({ id: order[i].id,
                            end: order[i].end,
                            title: order[i].title,
                            start: order[i].start,
                            backgroundColor: '#f56954',//red
                            borderColor    : '#f56954'//red
                            });
            }
            if (order[i].status=='proceso'){
                event.push({ id: order[i].id,
                            end: order[i].end,
                            title: order[i].title,
                            start: order[i].start,
                            backgroundColor: '#f39c12', //yellow
                            borderColor    : '#f39c12' //yellow
                            });
            }
            if (order[i].status=='preparado'){
                event.push({ id: order[i].id,
                            end: order[i].end,
                            title: order[i].title,
                            start: order[i].start,
                            backgroundColor: '#0073b7', //Blue
                            borderColor    : '#0073b7' //Blue
                            });
            }
            if (order[i].status=='entregado'){
                event.push({ id: order[i].id,
                            end: order[i].end,
                            title: order[i].title,
                            start: order[i].start,
                            backgroundColor: '#00a65a', //Success (green)
                            borderColor    : '#00a65a' //Success (green)
                            });
            }
        console.log(event[i]);
        }

        $('#calendar').fullCalendar({

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '2017-08-12',
            locale:initialLocaleCode,
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: event,
        });
        
    });

</script>
<style>

    body {
        margin: 40px 10px;
        padding: 0;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

</style>
</head>
<body>

    <div id='calendar'></div>

</body>
</html>
