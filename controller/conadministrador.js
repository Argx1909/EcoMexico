var operaciones="../model/modadministrador.php";
var confiadministrador = new Vue({    
  el: "#confiadministrador",   
  data:{
    ctAreas:[], 
    ctRooles:[],
    ctDatos:[],
    ctAdministradores:[],
    ctCuentas:[],
    administrador:"",
    nombre:"",
    paterno:"",
    materno:"",
    direccion:"",
    telefono:"",
    area:"",   
    email:"",
    password:"",  
    rool:"", 
    telefonoact:"",
    emailact:"",
    passwordact:"",    
  },     
  methods:{
    insertardatos:function(){
      this.nombre=document.getElementById("txtInsNombre").value;
      this.paterno=document.getElementById("txtInsPaterno").value;
      this.materno=document.getElementById("txtInsMaterno").value;
      this.direccion=document.getElementById("txtInsDireccion").value;
      this.telefono=document.getElementById("txtInsTelefono").value;
      this.area=document.getElementById("cmbArea").value; 
      if(this.nombre==0 || this.paterno==0 || this.materno==0 || this.direccion==0 || this.telefono==0 || this.area==0){
        this.mserror();
      }else{
        axios.post(operaciones,{opcion:1,nombre:this.nombre,paterno:this.paterno,materno:this.materno,direccion:this.direccion,telefono:this.telefono,area:this.area}).then(response =>{
          this.ctDatos=response.data;
          this.listaadministradores();
          this.msinsert("Administrador registrado");
          this.limpiarIns();
        });
      }
    },
    insertarcuenta:function(){
      this.administrador=document.getElementById("cmbDatos").value;
      this.rool=document.getElementById("cmbRool").value;
      this.email=document.getElementById("txtInsEmail").value;
      this.password=document.getElementById("txtInsPassword").value;
      if(this.administrador==0){
        this.mserrordatos();
      }else{
        if(this.rool==0 || this.email==0 || this.password==0){
          this.mserror();
        }else{
          cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!cadena.test(this.email)){
            this.msemail();
          }else{
            axios.post(operaciones,{opcion:2,administrador:this.administrador,rool:this.rool,email:this.email,password:this.password}).then(response =>{           
              this.listacuentas();
              this.msinsert("Cuenta registrada");
              this.limpiarCuenta();
            });
          }
        }
      }
    },
    actualizar:function(){ 
      this.nombre=document.getElementById("txtUpdNombre").value;
      this.paterno=document.getElementById("txtUpdPaterno").value;
      this.materno=document.getElementById("txtUpdMaterno").value;
      this.direccion=document.getElementById("txtUpdDireccion").value;
      this.telefono=document.getElementById("txtUpdTelefono").value;
      this.email=document.getElementById("txtUpdEmail").value;
      this.password=document.getElementById("txtUpdPassword").value;
      this.telefonoact=document.getElementById("txtDelTelefono").value;
      this.emailact=document.getElementById("txtDelEmail").value;
      this.passwordact=document.getElementById("txtDelPassword").value;
      if(this.nombre==0 || this.paterno==0 || this.materno==0 || this.direccion==0 || this.telefono==0 || this.email==0 || this.password==0){
        this.mserror();
      }else{
        cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!cadena.test(this.email)){
          this.msemail();
        }else{
          axios.post(operaciones,{opcion:3,nombre:this.nombre,paterno:this.paterno,materno:this.materno,direccion:this.direccion,telefono:this.telefono,email:this.email,password:this.password,telefonoact:this.telefonoact,emailact:this.emailact,passwordact:this.passwordact}).then(response =>{
            this.msupdate();
            window.location.href="cerrarsesion.php";
          });
        }
      }
    },  
    inabilitarcuenta:function(){
      this.email=document.getElementById("txtDelEmail").value;
      this.password=document.getElementById("txtDelPassword").value;
      Swal.fire({
        text: "¿Esta seguro de inabilitar su cuenta?:"+"\n"+this.emailact,
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
          axios.post(operaciones,{opcion:5,email:this.email,password:this.password}).then(response =>{           
            window.location.href="cerrarsesion.php";
          }),             
          Swal.fire(
            'Procesando',
            'Su cuenta ha sido inabilitado',
            'success'
          )
        }
      })
    },
    //combobox de agregar area 1
    editarestado:function(idusuario,acceso,administrador){
      if(acceso=="Concedido"){acceso="Denegado";}else{acceso="Concedido";}
      Swal.fire({
        text: "¿Esta seguro de denegar el acceso a este administrador?"+"\n"+administrador,
        imageUrl:'../src/img/multimedia/administrador.png',         
        imageWidth: 100,
        imageHeight: 100,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText:'Cancelar',          
        confirmButtonColor:'#13CBBA',          
        cancelButtonColor:'#CB131B',  
      }).then((result) => {
        if(result.value){  
          axios.post(operaciones,{opcion:4,acceso:acceso,idusuario:idusuario}).then(response =>{           
            this.listacuentas();
          }),            
          Swal.fire(
            'Procesado',
            'La cuenta ha sido suspendida',
            'success'
          )
        }
      })
    },
    listaareas:function(){
      axios.post(operaciones,{opcion:6}).then(response =>{
        this.ctAreas=response.data;      
      });
    },
    //apartado cuenta combobox roles 2
    listarooles:function(){
      axios.post(operaciones,{opcion:7}).then(response =>{
        this.ctRooles=response.data;      
      });
    },
    //apartado agregar tabla 1
    listaadministradores:function(){
      axios.post(operaciones,{opcion:8}).then(response =>{
        this.ctAdministradores=response.data;      
      });
    },
    //apartado cuenta tabla 2
    listacuentas:function(){
      axios.post(operaciones,{opcion:9}).then(response =>{
        this.ctCuentas=response.data;      
      });
    },
    limpiarIns:function(){
      document.getElementById("txtInsNombre").value=null;
      document.getElementById("txtInsPaterno").value=null;
      document.getElementById("txtInsMaterno").value=null;
      document.getElementById("txtInsDireccion").value=null;
      document.getElementById("txtInsTelefono").value=null;
      document.getElementById("cmbArea").value=0;
      document.getElementById("txtInsEmail").value=null;
      document.getElementById("txtInsPassword").value=null; 
      document.getElementById("cmbRool").value=0;
    },
    limpiarCuenta:function(){
      document.getElementById("cmbDatos").value=0;
      document.getElementById("cmbRool").value=0;
      document.getElementById("txtInsEmail").value=null;
      document.getElementById("txtInsPassword").value=null;
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
    mserrordatos:function(){
      Swal.fire({
        text: 'Error...'+'\n'+'debes agregar primero los datos del administrador en el apartado agregar',
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
    msupdate:function(){
      Swal.fire(
        'Procesando',
        'Tus datos han sido actualizados.',
        'success',
      )
    }
  }, 
  created:function(){
    this.listaareas();
    this.listarooles();
    this.listaadministradores();
    this.listacuentas();
  }
});