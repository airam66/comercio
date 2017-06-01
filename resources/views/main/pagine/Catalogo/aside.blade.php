
<div class="panel panel-success">
   <div class="panel-heading" >
             Eventos
   </div>
   <div class="panel-body">

          <ul class="list-group">
           @foreach($events as $event)
                     
          <li class="list-group-item"  > 
          <a href="{{route('searchEvent',$event->name)}}">
             <div style="color: black;">{{$event->name}}</div>  
          </a>
          </li>
          @endforeach
         </ul> 
            
 </div>
       
</div>