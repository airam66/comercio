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
            id= order[i].id;
            x='orders/'+id+'/pdf';
            d=order[i].end;
            date=d.substring(0,10);
           
            if (order[i].status=='pendiente'){
                event.push({ id: order[i].id,
                            title: order[i].title,
                            start: date,
                            backgroundColor: '#dd4b39',//red
                            borderColor    : '#dd4b39',//red
                            url:x
                            });
            }
            if (order[i].status=='proceso'){
                event.push({ id: order[i].id,
                            title: order[i].title,
                            start: date,
                            backgroundColor: '#f39c12', //yellow
                            borderColor    : '#f39c12', //yellow
                            url:x
                            });
            }
            if (order[i].status=='preparado'){
                event.push({ id: order[i].id,
                            title: order[i].title,
                            start: date,
                            backgroundColor: '#3c8dbc', //Blue
                            borderColor    : '#3c8dbc', //Blue
                           url:x                          
                            });
            }
            if (order[i].status=='entregado'){
                event.push({ id: order[i].id,
                            title: order[i].title,
                            start: date,
                            backgroundColor: '#00a65a', //Success (green)
                            borderColor    : '#00a65a', //Success (green)
                            url:x
                            });
            }
        
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
        margin-top: 40px;
        text-align: center;
        font-size: 14px;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    }

#external-events a{
    text-decoration: none;
    color:white;
}
        
    #wrap {
        width: 1100px;
        margin: 0 auto;
    }
        
    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        border: 1px solid #e97c7c;
        background: pink;
        
    }
        
    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
    }
        
    #external-events .yellow-event {
        margin: 10px 0;
        cursor: pointer;
         background-color: #f39c12;
         position: relative;
    display: block;
    border-radius: 3px;
    border: 1px solid #d47c19;
    padding-bottom: 5px;
    padding-top: 5px;
    }

     #external-events .red-event {
      background-color: #dd4b39;
       margin: 10px 0;
        cursor: pointer;
    position: relative;
    display: block;
    border-radius: 3px;
    border: 1px solid #db1399;
    padding-bottom: 5px;
    padding-top: 5px;
    

    }

    #external-events .blue-event {
      background-color: #3c8dbc;
       margin: 10px 0;
        cursor: pointer;
       position: relative;
    display: block;
    border-radius: 3px;
    border: 1px solid #3a87ad;
    padding-bottom: 5px;
     padding-top: 5px;
    }

    #external-events .green-event {
      background-color: #00a65a;
       margin: 10px 0;
        cursor: pointer;
      position: relative;
    display: block;
    border-radius: 3px;
    border: 1px solid #118383;
    padding-bottom: 5px;
    padding-top: 5px;
    }
    
    #external-events .grey-event {
    background-color: #494d4b;
    margin: 10px 0;
    cursor: pointer;
    position: relative;
    display: block;
    border-radius: 3px;
    border: 1px solid #2b2f2f;
    padding-bottom: 5px;
    padding-top: 5px;
}  
    
    #calendar {
        float: right;
        width: 900px;
    }

</style>
</head>
<body>
<div id='wrap'>

        @include('admin.orders.asideStatus')

    <div id='calendar'></div>
<div style='clear:both'></div>

</div>

</body>
</html>
