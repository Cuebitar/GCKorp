<template lang="">
  <!--Remember to do comment for every section so we can easily differentiate section-->
  <div>
      <!--Header-->
      <UniHeader :isAdmin="isAdmin"></UniHeader>
  </div>
  
      <!--Content-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <div class="withdrawal-page">
      <h1>Favourite Account</h1>

      <Button class="display: grid; border: 2px solid red; padding: 10px;" 
      @click="addNew">Add New Favourite Bank
      </Button>

            <DataView :value="bankAccount">
              <template #list="slotProps">
                <div class="col-3 sm:col-6 lg:col-12 xl:col-4 p-2">
                    <div class="p-4 border-1 surface-border surface-card border-round">
                        <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                            <div class="flex align-items-center gap-2">
                                <span class="font-semibold">Favourite Account {{ slotProps.data.id }}</span>
                            </div>
                        </div>

                        
                        <div class="flex flex-column align-items-center gap-3 py-3">
                            <div class="text-2xl font-bold">{{ slotProps.data.bankName }}</div>
                        </div>

                        <div class="flex flex-column align-items-center gap-3 py-5">
                            <div class="text-2xl font-bold">Account No: {{ slotProps.data.accountNo }}</div>
                        </div>


                        <div class="flex align-items-center justify-content-between">
                          <Button @click="delete_bankAccount(slotProps.data)" >Edit </Button>
                            <Button @click="delete_bankAccount(slotProps.data)" >Delete </Button>                        
                          </div>
                    </div>
                </div>
              </template>
            </DataView>
    
</div>



</template>


<script>
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios'
import { useRouter } from 'vue-router';

export default {
  props: {
    isAdmin: Boolean,
  },
mounted () {
  //getting user data
  this.loadlist();
},
data(){
  return {
    router: useRouter(),
    bankAccount: [],
    showModal: false,
  
  };
},

methods:{
  addNew() {
    // Navigate directly to the add bank account page
    this.$router.push('/favouriteadd'); 
  },
  delete_bankAccount(index){
			this.bankAccount.splice(this.bankAccount.indexOf(index), 1);
	},
  async loadlist(){
    await this.$axios.get('/api/bankAccount/accountByUser/' + $route.params.id, {
      headers: {
        Authorization: "Bearer " + this.$cookies.get('token')
      }
    })
    .then(response => {
      this.bankAccount = response.data.data;            
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }
  
  
  
},
}
</script>

<style scoped>

h1 {
  text-align: center;
  margin-bottom: 20px;
}

.input-group {
  display: flex;
  align-items: center; /* Vertically align the label with the textbox */
  margin-bottom: 15px;
  justify-content: space-between; /* Separates the label and the input fields */
}

label {
  width: 30%; /* Adjust this percentage based on your design preference */
  margin-right: 10px; /* Add some spacing between the label and the input */
}

input[type="text"], input[type="email"], input[type="password"], select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}


button:hover {
  background-color: #0056b3;
}

.button-group {
  display: flex;
  justify-content: space-between;  /* Adjust based on the spacing you want */
  align-items: center;
  margin-top: 25px;
}

.button-group button {
  margin: 0 5px; /* This provides spacing on both sides of each button */
}

.data-box {
  background-color: #fff;
  border: 1px solid #e0e0e0;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-top: 20px;
}

.statement-wrapper {
  display: flex;
  width: 100%;
  align-items: center;
}

.statement-wrapper input[type="text"] {
  flex-grow: 1;  /* It takes the maximum width available, pushing the button to the end. */
  margin-right: 10px; /* Some spacing between the input and the button */
}

.statement-wrapper button {
  width: 70px;       /* Set explicit width */
  text-align: center; 
  font-size: 14px;   /* Optional: Adjust font size if needed */
}

/* The Modal (background) */
.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  background-color: rgba(0,0,0,0.7); 
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
  text-align: center;
  position: relative;
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  position: absolute;
  top: 0;
  right: 15px;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>