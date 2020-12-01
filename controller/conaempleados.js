var operaciones="../model/modaempleados.php";
var admempleados = new Vue({    
  el: "#admempleados",   
  data:{    
    ctEmpleados:[],
    ctAreas:[],
    clave:"",
    nombre:"",
    paterno:"",
    materno:"",   
    direccion:"",
    telefono:"",  
    area:"",
  },     
  methods:{
    insertar:function(){
        this.nombre=document.getElementById("txtInsnombre").value;
        this.paterno=document.getElementById("txtInspaterno").value;
        this.materno=document.getElementById("txtInsmaterno").value;
        this.direccion=document.getElementById("txtInsdireccion").value;
        this.telefono=document.getElementById("txtInstelefono").value;
        this.area=document.getElementById("cmbInsareas").value;
        if(this.nombre==0 || this.paterno==0 || this.materno==0 || this.direccion==0 || this.telefono==0 ||this.area== 0){
            this.mserror();
        }else{
            axios.post(operaciones,{opcion:3,nombre:this.nombre,paterno:this.paterno,materno:this.materno,direccion:this.direccion,telefono:this.telefono,area:this.area}).then(response =>{
                this.listaempleados(); 
                this.msinsert();    
                this.limpiar();
            });
        }
    },
    cargarvalue:function(clave,nombre,paterno,materno,direccion,telefono,area){
        this.clave=clave;
        document.getElementById("txtUpdnombre").value=nombre;
        document.getElementById("txtUpdpaterno").value=paterno;
        document.getElementById("txtUpdmaterno").value=materno;
        document.getElementById("txtUpddireccion").value=direccion;
        document.getElementById("txtUpdtelefono").value=telefono;
        document.getElementById('cmbUpdareas').value=area;
    },
    editar:function(){
        this.nombre=document.getElementById("txtUpdnombre").value;
        this.paterno=document.getElementById("txtUpdpaterno").value;
        this.materno=document.getElementById("txtUpdmaterno").value;
        this.direccion=document.getElementById("txtUpddireccion").value;
        this.telefono=document.getElementById("txtUpdtelefono").value;
        this.area=document.getElementById('cmbUpdareas').value;
        if(this.nombre==0 || this.paterno==0 || this.materno==0 || this.direccion==0 || this.telefono==0 || this.area==0){
            this.mserror();
        }else{
            axios.post(operaciones,{opcion:4,clave:this.clave,nombre:this.nombre,paterno:this.paterno,materno:this.materno,direccion:this.direccion,telefono:this.telefono,area:this.area}).then(response =>{
                this.listaempleados();
                this.msupdate();
            });
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
            axios.post(operaciones,{opcion:5,clave:clave}).then(response =>{           
              this.listaempleados();
            }),             
            Swal.fire(
              '¡Eliminado!',
              'El registro ha sido borrado.',
              'success'
            )
          }
        })
    },
    listaempleados:function(){
      axios.post(operaciones,{opcion:1}).then(response =>{
        this.ctEmpleados=response.data;      
      });
    },
    listaareas:function(){
        axios.post(operaciones,{opcion:2}).then(response =>{
          this.ctAreas=response.data;      
        });
    },
    limpiar:function(){
        document.getElementById("txtInsnombre").value=null;
        document.getElementById("txtInspaterno").value=null;
        document.getElementById("txtInsmaterno").value=null;
        document.getElementById("txtInsdireccion").value=null;
        document.getElementById("txtInstelefono").value=null;
        document.getElementById("cmbInsareas").value=0;
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
          title:'Empleado registrado'
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
    this.listaempleados();
    this.listaareas();
  }
});