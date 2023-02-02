   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
      @if(count($results)>0)
<ul style="background-color: white;" class="googleul">
     
           @foreach($results as $rows)
            <li><a href="{{$rows->link}}"  target="_blank">{{$rows->title}}</a></li>
           @endforeach
          
</ul>

 @else
     <ul style="background-color: white;" class="googleul">
          <li><a href="#"  target="_blank">Not available</a></li>
         </ul>      
           @endif

