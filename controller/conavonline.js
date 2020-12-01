var operaciones="../model/modavonline.php";
var vonline = new Vue({    
  el: "#vonline",   
  data:{    
    ctVonline:[],
  },     
  methods:{
    listavonline:function(){
      axios.post(operaciones,{opcion:1}).then(response =>{
        this.ctVonline=response.data;      
      });
    },
  }, 
  created:function(){
    this.listavonline();
  }
});