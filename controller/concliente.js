var operaciones="../model/modclientes.php";
var conficliente = new Vue({    
  el: "#conficliente",   
  data:{    
    ctCompras:[],
    emailact:"",
    passwordact:"", 
    emailnue:"",
    passwordnue:"", 
    nombre:"",
    paterno:"",
    materno:"",     
  },     
  methods:{
    actualizar:function(){ 
      this.emailact=document.getElementById("txtEmailActual").value;
      this.passwordact=document.getElementById("txtPasswordActual").value;
      this.emailnue=document.getElementById("txtNuevoEmail").value;
      this.passwordnue=document.getElementById("txtPasswordNuevo").value;
      if(this.emailnue==0 || this.passwordnue==0){
        this.mserror();
      }else{
        cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!cadena.test(this.emailnue)){
          this.msemail();
        }else{
          Swal.fire({
            text: "¿Esta seguro de actualizar sus datos?:",
            imageUrl: '../src/img/multimedia/email.png',         
            imageWidth: 100,
            imageHeight: 100,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText:'Cancelar',          
            confirmButtonColor:'#13CBBA',          
            cancelButtonColor:'#CB131B',  
          }).then((result) => {
            if (result.value) {            
              axios.post(operaciones,{opcion:1,emailact:this.emailact,passwordact:this.passwordact,emailnue:this.emailnue,passwordnue:this.passwordnue}).then(response =>{
                this.limpiar();
                window.location.href="cerrarsesion.php";
              }),
              Swal.fire(
                'Actualizando',
                'Datos actulizados correctamente',
                'success'
              )           
            }
          })
        }
      }
    },  
    eliminar:function(){
      this.emailact=document.getElementById("txtEmailActual").value;   
      this.passwordact=document.getElementById("txtPasswordActual").value;
      Swal.fire({
        text: "¿Esta seguro de eliminar su cuenta?:"+"\n"+this.emailact,
        imageUrl: '../src/img/multimedia/email.png',         
        imageWidth: 100,
        imageHeight: 100,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText:'Cancelar',          
        confirmButtonColor:'#13CBBA',          
        cancelButtonColor:'#CB131B',  
      }).then((result) => {
        if(result.value) {         
          axios.post(operaciones,{opcion:2,emailact:this.emailact,passwordact:this.passwordact}).then(response =>{           
            window.location.href="cerrarsesion.php";
          }),             
          Swal.fire(
            'Eliminando',
            'El registro ha sido eliminado',
            'success'
          )
        }
      })
    },
    listacompras:function(){
      this.nombre=document.getElementById("txtNombre").value;
      this.paterno=document.getElementById("txtPaterno").value;
      this.materno=document.getElementById("txtMaterno").value;
      axios.post(operaciones,{opcion:3,nombre:this.nombre,paterno:this.paterno,materno:this.materno}).then(response =>{
        this.ctCompras=response.data;      
      });
    },
    limpiar:function(){
      document.getElementById("txtNuevoEmail").value=null;
      document.getElementById("txtPasswordNuevo").value=null;
    },
    mserror:function(){
      Swal.fire({
        text: 'Existen campos vacios',
        imageUrl: '../src/img/multimedia/error.png',
        imageWidth: 100,
        imageHeight: 100,
        imageAlt: 'Custom image',
        confirmButtonText: 'Aceptar', 
        confirmButtonColor:'#13CBBA',
      })
    },
    msemail:function(){
      Swal.fire({
        text: 'Email no valido',
        imageUrl: '../src/img/multimedia/email.png',
        imageWidth: 100,
        imageHeight: 100,
        imageAlt: 'Custom image',
        confirmButtonText: 'Aceptar', 
        confirmButtonColor:'#13CBBA',
      })
    },
    msupdate:function(){
      Swal.fire(
        'Actualizado',
        'El registro ha sido actualizado.',
        'success',
      )
    }
  }, 
  created:function(){
    this.listacompras();
  }
});