$('#formLogin').submit(function(e){                         
    e.preventDefault(); 
    var usuario = $.trim($("#usuario").val());
    var password = $.trim($("#password").val());
    if(usuario.length == "" || password.length == ""){
        Swal.fire({
          type: 'warning',
          title: 'Ingrese Usuario y/o Password',                          
        }); 
        return false;
    }else{    
        $.ajax({
          url:"bd/login.php",
          type:"POST",    
          datatype:"json",    
          data:  {usuario:usuario, password:password},    
          success: function(data) {
              console.log(data);
              if(data == "null"){ //null si no hay nada devuelve un null 
                  Swal.fire({
                      type: 'error',
                      title: 'Usuario y/o Password incorrectas',                          
                    });                    
              }else{                  
                  Swal.fire({
                      type: 'success',                          
                      title: '¡Conexión exitosa!',                                                
                      confirmButtonColor: '#3085d6',                          
                      confirmButtonText: 'Ingresar'
                    }).then((result) => { //capturamos el resultado
                      if (result.value) {
                          window.location.href = "vistas/pag_inicio.php";                          
                      }
                    })                                                               
              }
           }
        });			            
    }
});