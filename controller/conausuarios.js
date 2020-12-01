var operaciones="../model/modausuarios.php";
var admusuarios = new Vue({    
  el: "#admusuarios",   
  data:{    
    ctUsuarios:[],
    ctPersonas:[],
    ctRooles:[],
    clave:"",
    persona:"",
    email:"",
    password:"",   
    rool:"",  
    acceso:"",
  },     
  methods:{
    insertar:function(){
      this.persona=document.getElementById("cmbInspersonas").value;
      this.email=document.getElementById("txtInsemail").value;
      this.password=document.getElementById("txtInspassword").value;
      this.rool=document.getElementById("cmbInsrooles").value;
      this.acceso=document.getElementById("cmbInsacceso").value;
      if(this.persona==0 || this.email==0 || this.password==0 || this.rool==0 || this.acceso==0){
        this.mserror();
      }else{
        cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!cadena.test(this.email)){
          this.msemail();
        }else{
          axios.post(operaciones,{opcion:4,persona:this.persona,email:this.email,password:this.password,rool:this.rool,acceso:this.acceso}).then(response =>{
            this.listausuarios();
            this.msinsert();
            this.limpiar();
          });
        }
      }
    },
    cargarvalue:function(clave,persona,email,password,rool,acceso){
      this.clave=clave;
      document.getElementById("cmbUpdpersonas").value=persona;
      document.getElementById("txtUpdemail").value=email;
      document.getElementById("txtUpdpassword").value=password;
      document.getElementById("cmbUpdrooles").value=rool;
      document.getElementById("cmbUpdacceso").value=acceso;
    },
    editar:function(){
      this.persona=document.getElementById("cmbUpdpersonas").value;
      this.email=document.getElementById("txtUpdemail").value;
      this.password=document.getElementById("txtUpdpassword").value;
      this.rool=document.getElementById("cmbUpdrooles").value;
      this.acceso=document.getElementById("cmbUpdacceso").value;
      if(this.persona==0 || this.email==0 || this.password==0 || this.rool==0 || this.acceso==0){
        this.mserror();
      }else{
        cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!cadena.test(this.email)){
          this.msemail();
        }else{
          axios.post(operaciones,{opcion:5,clave:this.clave,persona:this.persona,email:this.email,password:this.password,rool:this.rool,acceso:this.acceso}).then(response =>{
            this.listausuarios();
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
          axios.post(operaciones,{opcion:6,clave:clave}).then(response =>{           
            this.listausuarios();
          }),             
          Swal.fire(
            '¡Eliminado!',
            'El registro ha sido borrado.',
            'success'
          )
        }
      })
    },
    listausuarios:function(){
      axios.post(operaciones,{opcion:1}).then(response =>{
        this.ctUsuarios=response.data;      
      });
    },
    listapersonas:function(){
      axios.post(operaciones,{opcion:2}).then(response =>{
        this.ctPersonas=response.data;      
      });
    },
    listarooles:function(){
      axios.post(operaciones,{opcion:3}).then(response =>{
        this.ctRooles=response.data;      
      });
    },
    limpiar:function(){
      document.getElementById("cmbInspersonas").value=0;
      document.getElementById("txtInsemail").value=null;
      document.getElementById("txtInspassword").value=null;
      document.getElementById("cmbInsrooles").value=0;
      document.getElementById("cmbInsacceso").value=0;
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
          title:'Usuario registrado'
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
    this.listausuarios();
    this.listapersonas();
    this.listarooles();
  }
});