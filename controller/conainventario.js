var operaciones="../model/modainventario.php";
var adminventario = new Vue({    
  el: "#adminventario",   
  data:{    
    ctInventario:[], 
    ctAgotados:[], 
  },     
  methods:{
    listainventario:function(){
      axios.post(operaciones,{opcion:1}).then(response =>{
        this.ctInventario=response.data;      
      });
    },
    listaagotados:function(){
      axios.post(operaciones,{opcion:2}).then(response =>{
        this.ctAgotados=response.data;      
      });
    }
  }, 
  created:function(){
    this.listainventario();
    this.listaagotados();
  }
});