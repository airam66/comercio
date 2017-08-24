<div id='external-events'>
      <h4>PEDIDOS</h4>
       @foreach($status as $statu)

        @if ($statu=='pendiente')
           <div class='red-event'><a href="{{route('searchStatus',$statu)}}">
             <b>{{strtoupper($statu)}}</b>
          </a></div>
        @endif

        @if ($statu=='preparado')
           <div class='blue-event'><a href="{{route('searchStatus',$statu)}}">
             <b>{{strtoupper($statu)}}</b>
          </a></div>
        @endif
      
         @if ($statu=='entregado')
           <div class='green-event'><a href="{{route('searchStatus',$statu)}}">
             <b>{{strtoupper($statu)}}</b>
          </a></div>
        @endif

        @if ($statu=='proceso')
           <div class='yellow-event'><a href="{{route('searchStatus',$statu)}}">
             <b>{{strtoupper($statu)}}</b>
          </a></div>
        @endif
      
       @endforeach
</div>
