$('#formLogin').submit(function(e){
    e.preventDefault();
    var username = $.trim($("#username").val());    
    var password =$.trim($("#password").val());    
     
    if(username.length == "" || password == ""){
       Swal.fire({
           type:'warning',
           title:'Debe ingresar un usuario y/o password',
       });
       return false; 
     }else{
         $.ajax({
            url:"BD/validate.php",
            type:"POST",
            datatype: "json",
            data: {username:username, password:password}, 
            success:function(data){               
                if(data == "null"){
                    Swal.fire({
                        type:'error',
                        title:'Usuario y/o password incorrecta',
                    }).then((result) => {
                        if(!result.value){
                            //window.location.href = "vistas/pag_inicio.php";
                            window.location.href = "Fronted/home.php";
                        }
                    });
                }else{
                    Swal.fire({
                        type:'success',
                        title:'¡Conexión exitosa!',
                        confirmButtonColor:'#3085d6',
                        confirmButtonText:'Ingresar'
                    }).then((result) => {
                        if(result.value){
                            window.location.href = "Fronted/home.php";
                        }
                    })
                    
                }
            }    
         });
     }     
 });