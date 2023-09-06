<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader :isAdmin="isAdmin"></UniHeader>
    </div>
    
        <!--Content-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <div class="withdrawal-page">
        <h1>Reject Reason Edit</h1>

        <div class="col-sm-4">
        <div>
          <h2>Add a Reject Reason</h2>
          <input
            type="text"

            id="description" 
            
            placeholder="Insert Reject Reason"
          >
        </div>
      </div>
  
        <br><Button @click="add_denyReason()">Add</Button>

        
  
        <DataView :value="denyReason" paginator :rows="10" class="shadow-5 mt-4 ">
                <template #list="slotProps">
                    <div class="col-12 grid mt-2 pb-2 dataViewCustom">
                        <span class="col-2"></span>
                        <span class="col-2">{{ slotProps.data.id }}</span>
                        <span class="col-6">{{ slotProps.data.description }}</span>
                        <Button @click="edit_denyReason(slotProps.data)" >Edit</Button>
                        <Button @click="delete_denyReason(slotProps.data)" >Delete</Button>



                </div>
                </template>
            </DataView>

            <div v-if="addShowModal" class="modal">
                <div class="modal-content">
                <span @click="doneCloseModal" class="close">&times;</span>Done!</div>
            </div>

            <div v-if="doneShowModal" class="modal">
                <div class="modal-content">
                <span @click="doneCloseModal" class="close">&times;</span>Done!</div>
            </div>
      
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
    //this.loadlist();
  },
  data(){
    return {
      router: useRouter(),
      denyReason: [
        {
            id:'1',
            description: 'Information Not Match',
        },
  
        {
            id:'2',
            description: 'Insufficient Amount',
        },
  
        {
            id:'3',
            description: 'Account Not Exist',
        },
    ],
        
        addShowModal: false,
        doneShowModal: false,
    
    };
  },
  
  methods:{
    
    add_denyReason() {
      
      this.addShowModal = true;
    },

    delete_denyReason() {
      this.doneShowModal = true;
    },
    doneCloseModal() {
        this.addShowModal = false;
        this.doneShowModal = false;
    },
    
    
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