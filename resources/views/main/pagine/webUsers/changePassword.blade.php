         <h3>Configuración de la cuenta</h3>    
            {!! Form::open(['route'=>'webUsers.changePassword', 'method'=>'PATCH'])!!}
                            
        
             {!! Field::password('password')!!}

              {!! Field::password('newpassword')!!}

              {!! Field::password('newpassword_confirmation')!!}
                    
         
              <div class="form-group">
              {!! Form::submit('Guardar cambios',['class'=>'btn btn-success'])!!}
              </div>
          
            {!! Form::close() !!}
