var operaciones="../model/modaproductos.php";
var admproductos = new Vue({    
  el: "#admproductos",   
  data:{    
    ctProductos:[],
    ctProveedores:[],
    producto:"",
    pcompra:"",
    pventa:"",
    cantidad:"",
    subtotal:"",
    imagen:"",
    descripcion:"",
    proveedor:"",
    categoria:"",
    urlIns:"",
    urlUpd:"",
    borrar:"",
  },     
  methods:{
    insertar:function(){
      this.producto=document.getElementById("txtInsproducto").value;
      this.pcompra=document.getElementById("txtInspcompra").value;
      this.cantidad=document.getElementById("txtInscantidad").value;
      this.imagen=document.getElementById("flInsproducto").files[0];
      this.descripcion=document.getElementById("txtInsdescripcion").value;
      this.proveedor=document.getElementById("cmbInsproveedor").value;
      this.categoria=document.getElementById("cmbInscategoria").value;
      if(this.producto==0 || this.pcompra==0 || this.cantidad==0 || this.imagen==null || this.descripcion==0 || this.proveedor==0 || this.categoria==0){
        this.mserror();
      }else{
        let insert=new FormData();
        this.pventa=(0.40*parseFloat(this.pcompra)+parseFloat(this.pcompra));
        this.subtotal=(this.cantidad*this.pcompra);
        insert.append("opcion",3);
        insert.append("producto",this.producto);
        insert.append("pcompra",this.pcompra);
        insert.append("pventa",this.pventa);
        insert.append("cantidad",this.cantidad);
        insert.append("subtotal",this.subtotal);
        insert.append("imagen",this.imagen);
        insert.append("descripcion",this.descripcion);
        insert.append("proveedor",this.proveedor);
        insert.append("categoria",this.categoria);
        axios.post(operaciones,insert).then(response=>{
          this.listaproductos();
          this.msinsert();
          this.limpiarIns();
        });
      }
    },
    cargarvalue:function(clave,producto,pcompra,cantidad,imagen,proveedor,categoria){
      this.clave=clave;
      document.getElementById("txtUpdproducto").value=producto;
      document.getElementById("txtUpdcompra").value=pcompra;
      document.getElementById("txtUpdcantidad").value=cantidad;
      document.getElementById("cmbUpdproveedor").value=proveedor;
      document.getElementById("cmbUpdcategoria").value=categoria;
      this.urlUpd='../src/img/productos/'+imagen;
      this.borrar=this.urlUpd;
    },
    editar:function(){
      this.producto=document.getElementById("txtUpdproducto").value;
      this.pcompra=document.getElementById("txtUpdcompra").value;
      this.cantidad=document.getElementById("txtUpdcantidad").value;
      this.imagen=document.getElementById("flUpdproducto").files[0];
      this.proveedor=document.getElementById("cmbUpdproveedor").value;
      this.categoria=document.getElementById("cmbUpdcategoria").value;
      this.pventa=(0.40*parseFloat(this.pcompra)+parseFloat(this.pcompra));
      this.subtotal=(this.cantidad*this.pcompra);
      if(this.producto==0 || this.pcompra==0 || this.cantidad==0 || this.proveedor==0 || this.categoria==0){
        this.mserror();
      }else{
        let update =new FormData();
        if(this.imagen==null){
          update.append("opcion",4);
          update.append("clave",this.clave);
          update.append("producto",this.producto);
          update.append("pcompra",this.pcompra);
          update.append("pventa",this.pventa);
          update.append("cantidad",this.cantidad);
          update.append("subtotal",this.subtotal);
          update.append("proveedor",this.proveedor);
          update.append("categoria",this.categoria);
          axios.post(operaciones,update).then(response =>{
            this.listaproductos();
            this.msupdate();
          });
        }else{
          update.append("opcion",4);
          update.append("clave",this.clave);
          update.append("producto",this.producto);
          update.append("pcompra",this.pcompra);
          update.append("pventa",this.pventa);
          update.append("cantidad",this.cantidad);
          update.append("subtotal",this.subtotal);
          update.append("imagen",this.imagen);
          update.append("proveedor",this.proveedor);
          update.append("categoria",this.categoria);
          update.append("borrar",this.borrar);
          axios.post(operaciones,update).then(response =>{
            this.listaproductos();
            this.msupdate();
          });
        }
      }
    },
    eliminar:function(clave,imagen){
      this.borrar='../src/img/productos/'+imagen;
      let delet=new FormData();
      delet.append("opcion",5);
      delet.append("clave",clave);
      delet.append("borrar",this.borrar);
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
          axios.post(operaciones,delet).then(response =>{           
            this.listaproductos();
          }),             
          Swal.fire(
            '¡Eliminado!',
            'El registro ha sido borrado.',
            'success'
          )
        }
      })
    },
    imgInsert:function(e){
        this.imagen=document.getElementById("flInsproducto").files[0];
        if(this.imagen.type=="image/jpeg" ||this.imagen.type=="image/png" ||this.imagen.type=="image/jpg"){
            var filereader = new FileReader();
            filereader.readAsDataURL(e.target.files[0])
            filereader.onload = (e) => {
                admproductos.urlIns = e.target.result
        }
        }else{
            this.mserror("Archivo no admitido");
        }
    },
    imgUpd:function(e){
        this.imagen=document.getElementById("flUpdproducto").files[0];
        if(this.imagen.type=="image/jpeg" ||this.imagen.type=="image/png" ||this.imagen.type=="image/jpg"){
            var filereader = new FileReader();
            filereader.readAsDataURL(e.target.files[0])
            filereader.onload = (e) => {
                admproductos.urlUpd = e.target.result
            }
        }else{
            this.mserror("Archivo no admitido");
        }
    },
    listaproductos:function(){
      let consproductos=new FormData();
      consproductos.append("opcion",1);
      axios.post(operaciones,consproductos).then(response =>{
        this.ctProductos=response.data;   
      });
    },
    listaproveedores:function(){
      let consproveedores=new FormData();
      consproveedores.append("opcion",2);
      axios.post(operaciones,consproveedores).then(response =>{
        this.ctProveedores=response.data;   
      });
    },
    limpiarIns:function(){
      this.urlIns=null;
      document.getElementById("txtInsproducto").value=null;
      document.getElementById("txtInspcompra").value=null;
      document.getElementById("txtInscantidad").value=null;
      document.getElementById("txtInsdescripcion").value=null;
      document.getElementById("cmbInsproveedor").value=0;
      document.getElementById("cmbInscategoria").value=0;
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
          title:'Producto registrado'
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
    this.listaproductos();
    this.listaproveedores();
  }
});