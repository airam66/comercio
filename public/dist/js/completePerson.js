$('#favoritesModalClient').on('shown.bs.modal', function () {
  $('#searchC').focus();
});

var options={
    url: function(p){
      return baseUrl('admin/autocompleteClient?p='+p);
         }, getValue:'cuil',
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var client = $('#cuil').getSelectedItemData();
                        $('#nombre').val(client.name);
                        $('#client_id').val(client.id);
                    },
                    onKeyEnterEvent: function () { 
                        var client = $('#cuil').getSelectedItemData();
                        $('#nombre').val(client.name);
                        $('#client_id').val(client.id);
                    }
                }
   };
  
  $("#cuil").easyAutocomplete(options);



function completeC($id,$number,$name){
    $('#cuil').val($number);
    $('#cuit').val($number);
    $('#nombre').val($name);
    $('#client_id').val($id);
    $('#favoritesModalClient').modal('hide');
  };

 
