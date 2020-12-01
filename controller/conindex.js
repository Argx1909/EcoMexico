var operaciones="../model/modindex.php";
var index = new Vue({    
  el: "#index",   
  data:{    
    ctTPUsuario:[],
    ctDatos:[],
    nombre:"",
    paterno:"",
    materno:"",
    direccion:"",
    telefono:"",
    rool:"",
    email:"",
    password:"", 
    cadena:"",
    idpersona:"",

    targeta:"",
    // cliente:"",
    expiracion:"",
    clave:"",
    // email:"",
    // password:"",
    // drenvio:"",
    idproducto:"",
    imagen:"",
    pventa:"",
    cantidad:"",
    subtotal:"",

  },     
  methods:{
    insertardatos:function(){
      this.nombre=document.getElementById("txtNombre").value;
      this.paterno=document.getElementById("txtPaterno").value;
      this.materno=document.getElementById("txtMaterno").value;
      this.direccion=document.getElementById("txtDireccion").value;
      this.telefono=document.getElementById("txtTelefono").value;
      if(this.nombre==0 || this.paterno==0 || this.materno==0 || this.direccion==0 || this.telefono==0){
        this.mserror();
      }else{
        axios.post(operaciones,{opcion:3,nombre:this.nombre,paterno:this.paterno,materno:this.materno,direccion:this.direccion,telefono:this.telefono}).then(response =>{
          this.ctDatos=response.data;
          this.msinsert("Datos guardados");
          this.limpiarregistro();
        });
      }
    },
    insertarcuenta:function(){
      this.idpersona=document.getElementById("cmbDatos").value;
      this.email=document.getElementById("txtCEmail").value;
      this.password=document.getElementById("txtCPassword").value;
      if(this.idpersona==0){
        this.mserrordatos();
      }else{
        if(this.email==0 || this.password==0){
          this.mserror();
        }else{
          cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!cadena.test(this.email)){
            this.msemail();
          }else{
            axios.post(operaciones,{opcion:4,idpersona:this.idpersona,email:this.email,password:this.password}).then(response =>{           
              this.msinsert("Cuenta registrada");
              this.limpiarCuenta();
            });
          }
        }
      }
    },
    iniciarsesion:function(){  
      this.rool=document.getElementById("cmbRool").value;
      this.email=document.getElementById("txtEmail").value;
      this.password=document.getElementById("txtPassword").value;
      if(this.email==0 || this.password==0 || this.rool==0){
        this.mserror("Existen campos vacios");
      }else{
          cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!cadena.test(this.email)){
            this.msemail();
            this.limpiarlogin();
          }else{
            axios.post(operaciones,{opcion:2,rool:this.rool,email:this.email,password:this.password}).then(response =>{
            if(response.data==null){
              this.msdenegado();
              this.limpiarlogin();
            }else{
              if(response.data=="AccessoConcedidoAdministrador"){
                window.location.href="menu.php";
              }else{
                window.location.href="index.php";
              }
            }
          });
        }
      }
    },  
    listatpusuarios:function(){
      axios.post(operaciones,{opcion:1}).then(response=>{
        this.ctTPUsuario=response.data;
      });
    },
    comprar:function(){
      this.targeta=document.getElementById("txttargeta").value;
      this.nombre=document.getElementById("txtpersona").value;
      this.expiracion=document.getElementById("txtexpiracion").value;
      this.clave=document.getElementById("txtclave").value;
      this.idproducto=document.getElementById("txtidproducto").value;
      this.imagen=document.getElementById("txtimagen").value;
      this.pventa=document.getElementById("txtpventa").value;
      this.cantidad=document.getElementById("txtcantidad").value;
      this.subtotal=(parseFloat(this.pventa)*this.cantidad);
      this.email=document.getElementById("txtemail").value;
      this.password=document.getElementById("txtpassword").value;
      if(this.targeta==0 || this.nombre==0 || this.expiracion==0 || this.clave==0 || this.cantidad==0 || this.email==0 || this.password==0){
        this.mserror();
      }else{
        cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!cadena.test(this.email)){
            this.msemail();
        }else{
          axios.post(operaciones,{opcion:5,email:this.email,password:this.password}).then(response=>{
            if(response.data=="existente"){
              axios.post(operaciones,{opcion:6,idproducto:this.idproducto,imagen:this.imagen,pventa:this.pventa,cantidad:this.cantidad,subtotal:this.subtotal,email:this.email,password:this.password}).then(response=>{
                this.msexitoso();
                this.limpiarcompra();
                window.location.href="productos.php";
              });
            }else{
              this.mscomprar();
            }
          });
        }
      }
    },
    limpiarlogin:function(){
      document.getElementById("txtEmail").value=null;
      document.getElementById("txtPassword").value=null;
      document.getElementById("cmbRool").value=0;
    },
    limpiarregistro:function(){
      document.getElementById("txtNombre").value=null;
      document.getElementById("txtPaterno").value=null;
      document.getElementById("txtMaterno").value=null;
      document.getElementById("txtDireccion").value=null;
      document.getElementById("txtTelefono").value=null;
    },
    limpiarCuenta:function(){
      document.getElementById("cmbDatos").value=0;
      document.getElementById("txtCEmail").value=null;
      document.getElementById("txtCPassword").value=null;
    },
    msinsert:function(mensaje){
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
      });
      Toast.fire({
        type:'success',
        title:mensaje
      })
    },
    mserror:function(){
      Swal.fire({
        text:'Existen campos vacios',
        imageUrl: '../src/img/multimedia/error.png',
        imageWidth: 100,
        imageHeight: 100,
        imageAlt: 'Custom image',
        confirmButtonText: 'Aceptar', 
        confirmButtonColor:'#13CBBA',
      })
    },
    mserrordatos:function(){
      Swal.fire({
        text: 'Error...'+'\n'+'debes agregar primero tus datos en el apartado agregar',
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
    msdenegado:function(){
      Swal.fire({
        title: 'Acceso denegado',
        text: 'Verifica tu usuario y contraseña',
        imageUrl: '../src/img/multimedia/logo.png',
        imageWidth: 200,
        imageHeight: 200,
        imageAlt: 'Custom image',
        confirmButtonText: 'Aceptar', 
        confirmButtonColor:'#13CBBA',
      })
    },
    mscomprar:function(){
      Swal.fire({
        title: 'Aviso',
        text: 'Si tu cuenta ya esta registrada verifica tu email y password, si no te invitamos a que te registres',
        imageUrl: '../src/img/multimedia/logo.png',
        imageWidth: 200,
        imageHeight: 200,
        imageAlt: 'Custom image',
        confirmButtonText: 'Aceptar', 
        confirmButtonColor:'#13CBBA',
      })
    },
    limpiarcompra:function(){
      document.getElementById("txttargeta").value=null;
      document.getElementById("txtpersona").value=null;
      document.getElementById("txtexpiracion").value=null;
      document.getElementById("txtclave").value=null;
      document.getElementById("txtcantidad").value=null;
      document.getElementById("txtemail").value=null;
      document.getElementById("txtpassword").value=null;
    },
    msexitoso:function(){
      Swal.fire(
        'Comprando',
        'Su compra ha sido finalizado.',
        'success'
      )
    }
  },
  created:function(){            
    this.listatpusuarios();   
  }
});