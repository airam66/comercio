function SearchLetter(letter){
  $value=letter;
  console.log($value);
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchCraftProducts')}}",
    data:{'searchL':$value},
    success: function(data){
      $('#mostrar').html(data);
       console.log(data);
    }
    
  });
  }