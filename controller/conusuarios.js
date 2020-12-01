var operaciones="../model/modusuarios.php";
var confiusuarios = new Vue({    
  el: "#confiusuarios",   
  data:{
    ctUsuarios:[],     
  },     
  methods:{ 
    editarestado:function(idusuario,acceso,cliente){
      if(acceso=="Concedido"){acceso="Denegado";}else{acceso="Concedido";}
      Swal.fire({
        text: "¿Esta seguro de denegar el acceso a este cliente?"+"\n"+cliente,
        imageUrl:'../src/img/multimedia/cliente.png',         
        imageWidth: 100,
        imageHeight: 100,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText:'Cancelar',          
        confirmButtonColor:'#13CBBA',          
        cancelButtonColor:'#CB131B',  
      }).then((result) => {
        if(result.value){  
          axios.post(operaciones,{opcion:1,acceso:acceso,idusuario:idusuario}).then(response =>{           
            this.listausuarios();
          }),            
          Swal.fire(
            'Procesado',
            'La cuenta ha sido suspendida',
            'success'
          )
        }
      })
    },
    listausuarios:function(){
      axios.post(operaciones,{opcion:2}).then(response =>{
        this.ctUsuarios=response.data;      
      });
    }
  }, 
  created:function(){
    this.listausuarios();
  }
});