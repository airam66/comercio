
<div class="panel panel-success">
   <div class="panel-heading text-center"  >
         <b>
           EVENTOS
         </b>    
   </div>
   <div class="panel-body">

          <ul class="list-group">
           @foreach($events as $event)
                     
          <li class="list-group-item"  > 
          <a href="{{route('searchEvent',$event->name)}}">
             <div style="color: gray;">{{$event->name}}</div>
          </a>
          </li>
          <hr />
          @endforeach
         </ul> 
            
 </div>
       
</div>