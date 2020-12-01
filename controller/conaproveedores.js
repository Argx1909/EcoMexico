var operaciones="../model/modaproveedores.php";
var admproveedores = new Vue({    
  el: "#admproveedores",   
  data:{    
    ctProveedores:[],
    clave:"",
    nombre:"",
    paterno:"",
    materno:"",   
    email:"",
    direccion:"",
    telefono:"",  
  },     
  methods:{
    insertar:function(){
        this.nombre=document.getElementById("txtInsnombre").value;
        this.paterno=document.getElementById("txtInspaterno").value;
        this.materno=document.getElementById("txtInsmaterno").value;
        this.email=document.getElementById("txtInsemail").value;
        this.direccion=document.getElementById("txtInsdireccion").value;
        this.telefono=document.getElementById("txtInstelefono").value;
        if(this.nombre==0 || this.paterno==0 || this.materno==0 || this.email== 0 || this.direccion==0 || this.telefono==0){
            this.mserror();
        }else{
            cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!cadena.test(this.email)){
                this.msemail();
                this.limpiar();
            }else{
                axios.post(operaciones,{opcion:2,nombre:this.nombre,paterno:this.paterno,materno:this.materno,email:this.email,direccion:this.direccion,telefono:this.telefono}).then(response =>{
                    this.listaproveedores(); 
                    this.msinsert();    
                    this.limpiar();
                });
            }
        }
    },
    cargarvalue:function(clave,nombre,paterno,materno,email,direccion,telefono){
        this.clave=clave;
        document.getElementById("txtUpdnombre").value=nombre;
        document.getElementById("txtUpdpaterno").value=paterno;
        document.getElementById("txtUpdmaterno").value=materno;
        document.getElementById("txtUpdemail").value=email;
        document.getElementById("txtUpddireccion").value=direccion;
        document.getElementById("txtUpdtelefono").value=telefono;
    },
    editar:function(){
        this.nombre=document.getElementById("txtUpdnombre").value;
        this.paterno=document.getElementById("txtUpdpaterno").value;
        this.materno=document.getElementById("txtUpdmaterno").value;
        this.email=document.getElementById("txtUpdemail").value;
        this.direccion=document.getElementById("txtUpddireccion").value;
        this.telefono=document.getElementById("txtUpdtelefono").value;
        if(this.nombre==0 || this.paterno==0 || this.materno==0 || this.email==0 || this.direccion==0 || this.telefono==0){
            this.mserror();
        }else{
            cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!cadena.test(this.email)){
                this.msemail();
            }else{
                axios.post(operaciones,{opcion:3,clave:this.clave,nombre:this.nombre,paterno:this.paterno,materno:this.materno,email:this.email,direccion:this.direccion,telefono:this.telefono}).then(response =>{
                    this.listaproveedores();
                    this.msupdate();
                });
            }
        }
    },
    eliminar:function(clave){
        Swal.fire({
          text: "¿Esta seguro de eliminar este registro?:"+clave,
          imageUrl: '../src/img/multimedia/eliminar.png',         
          imageWidth: 100,
          imageHeight: 100,
          showCancelButton: true,
          confirmButtonText: 'Aceptar',
          cancelButtonText:'Cancelar',          
          confirmButtonColor:'#13CBBA',          
          cancelButtonColor:'#CB131B',  
        }).then((result) => {
          if (result.value) {            
            axios.post(operaciones,{opcion:4,clave:clave}).then(response =>{           
              this.listaproveedores();
            }),             
            Swal.fire(
              '¡Eliminado!',
              'El registro ha sido borrado.',
              'success'
            )
          }
        })
    },
    listaproveedores:function(){
      axios.post(operaciones,{opcion:1}).then(response =>{
        this.ctProveedores=response.data;      
      });
    },
    limpiar:function(){
        document.getElementById("txtInsnombre").value=null;
        document.getElementById("txtInspaterno").value=null;
        document.getElementById("txtInsmaterno").value=null;
        document.getElementById("txtInsemail").value=null;
        document.getElementById("txtInsdireccion").value=null;
        document.getElementById("txtInstelefono").value=null;
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
    msinsert:function(){
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });
        Toast.fire({
          type:'success',
          title:'Proveedor registrado'
        })
    },
    msupdate:function(){
        Swal.fire(
          'Actualizado',
          'El registro ha sido actualizado.',
          'success'
        )
    },
  }, 
  created:function(){
    this.listaproveedores();
  }
});