var operaciones="../model/modaventas.php";
var admventas = new Vue({    
  el: "#admventas",   
  data:{    
    ctProductos:[],
    ctPreventa:[],
    subtotal:"",
    cantidad:"",
    total:"",
    piezas:"",
  },     
  methods:{
    insertar:async function(idproducto,imagen,producto,pventa){
      await Swal.fire({
      title: 'EcoMexico',
      html:'<div class="row"><label class="col-sm-3 col-form-label">Cantidad</label><div class="col-sm-7"><input id="txtCantidad" type="number" min="1" value="1" class="form-control" /></div></div>', 
      confirmButtonText: 'Guardar', 
      showCancelButton: true,                         
      }).then((result) => {
        if (result.value) {  
          this.cantidad = document.getElementById('txtCantidad').value  
          if(this.cantidad>0){
            let insert=new FormData();
            this.subtotal=(parseFloat(pventa)*this.cantidad);
            insert.append("opcion",3);
            insert.append("idproducto",idproducto);
            insert.append("imagen",imagen);
            insert.append("producto",producto);         
            insert.append("pventa",pventa);
            insert.append("cantidad",this.cantidad);
            insert.append("subtotal",this.subtotal);
            axios.post(operaciones,insert).then(response=>{
              this.listapreventa();
              this.msinsert();
            });  
          }else{
            this.mserror();
          }        
        }
      });
    },
    editar:async function(clave,pventa,cant){                            
      await Swal.fire({ 
      title: 'EcoMexico',
      html:'<div class="row"><label class="col-sm-3 col-form-label">Cantidad</label><div class="col-sm-7"><input id="txtCantidad" type="number" min="1" value="'+cant+'" class="form-control" /></div></div>', 
      confirmButtonText: 'Guardar', 
      showCancelButton: true,                        
      }).then((result) => {
        if (result.value) {    
          this.cantidad=document.getElementById('txtCantidad').value;                                           
          if(this.cantidad>0){
              let update=new FormData();
              this.subtotal=(parseFloat(pventa)*this.cantidad);
              update.append("opcion",4);
              update.append("clave",clave);
              update.append("pventa",pventa);
              update.append("cantidad",this.cantidad);
              update.append("subtotal",this.subtotal);
              axios.post(operaciones,update).then(response=>{
                this.listapreventa();
                this.msupdate();
              });
          }else{
            this.mserror();
          }                 
        }
      }); 
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
          let delet=new FormData();
          delet.append("opcion",5);
          delet.append("clave",clave);        
          axios.post(operaciones,delet).then(response =>{           
            this.listapreventa();
          }),             
          Swal.fire(
            '¡Eliminado!',
            'El registro ha sido borrado.',
            'success'
          )
        }
      })
    },
    finalizar:async function(total,piezas){
      await Swal.fire({
      title: 'EcoMexico',
      html:'<div class="row"><label class="col-sm-3 col-form-label">Total</label><div class="col-sm-7"><input id="txtTotal" type="number" min="1" value="'+total+'" class="form-control" readonly="true"/></div></div><div class="row"><label class="col-sm-3 col-form-label">Pago</label><div class="col-sm-7"><input id="txtPago" type="number" min="0" value="0" class="form-control"/></div></div>', 
      confirmButtonText: 'Cobrar', 
      showCancelButton: true,                         
      }).then((result) => {
          if (result.value) {
              this.pago=document.getElementById("txtPago").value;
              if(this.pago>=total && total>0){
                  this.cambio=this.pago-total;
                  Swal.fire({
                      title: 'EcoMexico',
                      text: 'Cambio:'+this.cambio,
                      imageUrl: '../src/img/multimedia/compra.jpg',
                      imageWidth: 100,
                      imageHeight: 100,
                      imageAlt: 'Custom image',
                      confirmButtonText: 'Aceptar', 
                      confirmButtonColor:'#13CBBA',
                  })
                  let insert=new FormData();
                  insert.append('opcion',6);
                  axios.post(operaciones,insert).then(response=>{
                    this.listapreventa();
                  }); 
              }else{
                  Swal.fire({
                    text: 'Operacion fallida',
                    imageUrl: '../src/img/multimedia/error.png',
                    imageWidth: 100,
                    imageHeight: 100,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'Aceptar', 
                    confirmButtonColor:'#13CBBA',
                  })
              }       
          }
      });
    },
    cancelarcompra:function(){
      Swal.fire({
        text: "¿Esta seguro de cancelar la compra?",
        imageUrl: '../src/img/multimedia/compra.jpg',         
        imageWidth: 100,
        imageHeight: 100,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText:'Cancelar',          
        confirmButtonColor:'#13CBBA',          
        cancelButtonColor:'#CB131B',  
      }).then((result) => {
        if (result.value) {    
          let cancelar=new FormData();
          cancelar.append("opcion",7);       
          axios.post(operaciones,cancelar).then(response =>{           
            this.listapreventa();
          }),             
          Swal.fire(
            '¡Cancelando!',
            'La compra ha sido borrado.',
            'success'
          )
        }
      })
    },
    listaproductos:function(){
      let consproductos=new FormData();
      consproductos.append("opcion",1);
      axios.post(operaciones,consproductos).then(response =>{
        this.ctProductos=response.data;   
      });
    },
    listapreventa:function(){
      let conspreventa=new FormData();
      conspreventa.append("opcion",2);
      axios.post(operaciones,conspreventa).then(response =>{
        this.ctPreventa=response.data;   
      });
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
        title:'Producto agregado'
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
    this.listapreventa();
  },
  computed:{
    Subtotal(){
      this.total = 0;
      for(preventa of this.ctPreventa){
        this.total = this.total + parseInt(preventa.flSubtotal);
      }
      return this.total;   
    },
    Piezas(){
      this.piezas = 0;
      for(preventa of this.ctPreventa){
        this.piezas = this.piezas + parseInt(preventa.intCantidad);
      }
      return this.piezas;   
    }
  }
});