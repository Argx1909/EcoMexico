var operaciones="../model/modnotificaciones.php";
var notificacion = new Vue({    
  el: "#notificacion",   
  data:{
    ctAgotados:[],    
  },     
  methods:{
    listaagotados:function(){
      axios.post(operaciones,{opcion:1}).then(response =>{
        this.ctAgotados=response.data;      
      });
    },
  }, 
  created:function(){
    this.listaagotados();
  }
});