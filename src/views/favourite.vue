<template>
    <UniHeader ></UniHeader>
    <div class="container mb-5 mt-5">

      <div class="row">
        <h1 class="font-bold">Favourite Account</h1>

        <button @click="addNew">Add new</button>

            <DataTable :value="bankAccount" tableStyle="min-width: 50rem">
                <Column field="id" header="ID"></Column>
                <Column field="accountNo" header="Account Number"></Column>
                <Column field="bankName" header="Bank Name"></Column>
                <Column :exportable="false" style="min-width:8rem">
                      <template #body="slotProps">
                <Button icon="pi pi-trash" outlined rounded severity="danger" @click="delete_bankAccount(slotProps.data)" />
                      </template>
                </Column>
            </DataTable>
            
      
</div>


</div>
<div class="jumbotron text-center mb-0">
  
</div>
</template>


<script>
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios'
export default {
mounted () {
    //getting user data
    this.loadlist();
  },
data(){
    return {
      bankAccount: [
        {
            id:'1',
            accountNo: '827061654174',
            bankName: 'Maybank',
        },

        {
            id:'2',
            accountNo: '7298404608',
            bankName: 'Public Bank',
        },

        {
            id:'3',
            accountNo: '8790461046',
            bankName: 'OCBC Bank',
        },
    ],
      showModal: false,
    
    };
  },

methods:{
  

    addNew() {
      // Navigate directly to the add bank account page
      this.$router.push({ path: '//registerBank' }); 
    },

    //delete bankAccount
    delete_bankAccount(deleteid){
      axios.delete('http://127.0.0.1:8000/user/delete/'+deleteid)
      .then((res) =>{
        console.log(res);
        this.loadlist();
      })
      .catch((e)=>{
        console.log(e);
      })
    }
},
}
</script>

<style scooped>
  button {
  display: block;
  width: 100%;
  padding: 10px 15px;
  background-color: #007BFF;
  color: #FFFFFF;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
} 
</style>