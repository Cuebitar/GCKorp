<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader :isAdmin="isAdmin"></UniHeader>
    </div>

        <!--Content-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <div class="withdrawal-details-page">
          <div v-if="!editMode">
            <h1>Withdrawal Request Details</h1>

            <Button @click="goBack">Back</Button>

            <div class="withdrawal-details-card">
              <div class="input-group">
                <label for="fullname">Full Name:</label>
                <input id="fullname" v-model="withdrawalDetails.fullname" disabled>
              </div>
              <div class="input-group">
                <label for="investaccount">Pay From:</label>
                <input id="investaccount" v-model="withdrawalDetails.investAccount" disabled>
              </div>
              <div class="input-group">
                <label for="bankaccount">Pay To:</label>
                <input id="bankaccount" v-model="withdrawalDetails.bankAccount" disabled>
              </div>
              <div class="input-group">
                <label for="amount">Amount (MYR) :</label>
                <input id="amount" v-model="withdrawalDetails.amount" disabled>
              </div>
              <div class="input-group">
                <label for="purpose">Purpose:</label>
                <input id="purpose" v-model="withdrawalDetails.purpose" disabled>
              </div>

              <!-- Button to perform action -->
                <div class="button-group">
                    <Button @click="deny">Deny</Button>
                    <Button @click="approve">Approve</Button>
                </div>

                <!-- Popup Modal when rejected -->
                <div v-if="denyShowModal" class="modal">
                    <div class="modal-content">
                      <Button @click="editDenyReason">Edit deny reason</Button><br />
                      <span @click="doneCloseReject" class="close">&times;</span>
                            <label for="deny-reason">Reason for deny:</label> 
                            <select name="deny-reason" id="deny-reason"> 
                            <option value="deny-reason-1">Information Not Match</option> 
                            <option value="deny-reason-2">Insufficient Amount</option> 
                            <option value="deny-reason-3">Account Not Exist</option> 
                            <option value="deny-reason-4">Others</option> 
                            </select>
                            <Button @click="approve">Confirm</Button>
                    </div>
                </div>


            <!-- Popup Modal after action done -->
            <div v-if="doneShowModal" class="modal">
                <div class="modal-content">
                <span @click="doneCloseModal" class="close">&times;</span>Review Done!</div>
            </div>

                
            </div>

            
          </div>
        </div>







</template>

<script>
export default {
  props: {
    isAdmin: Boolean,
    id: Integer
  },
    data() {
    return {
      withdrawalDetails: {
        fullname: "Vincent John Doe",
        investAccount: "5449 4985 5959 5995",
        bankAccount: "1234 5667 1949 2625 (Maybank)",
        amount: "30,000",
        purpose: "To invest in the gold..."
      },
      editMode: false,
      denyShowModal: false,
      doneShowModal: false
    };
 
    },

    methods: {
    goBack() {
      this.$router.push({ path: '/adminWithdrawalList' }); 
    },
    deny() {
      this.denyShowModal = true;
    },
    approve() {
      this.doneShowModal = true;
    },
    doneCloseModal() {
      this.doneShowModal = false;
      this.$router.push({ path: '/adminWithdrawalList' }); 
    },
    doneCloseReject() {
      this.denyShowModal = false;
    },
    editDenyReason(){
      this.$router.push({ path: '/denyReason' }); 
    }
    
  }
};
</script>




<style scoped>
h1 {
  font-size: 32px;  
  font-weight: bold;
  margin-bottom: 20px;  
  text-align: center; /* This will center the text inside the h1 element */
  width: 100%;  /* Ensures the h1 takes full width of its container */
}

.withdrawal-details-page {
  display: flex;
  justify-content: center;
  align-items: flex-start; /* Aligns items to the start of the container */
  height: 100vh;
  background-color: #f5f5f5;
  font-size: 18px;
  padding-top: 20px; /* Pushes the content down from the top */
}

.withdrawal-details-card {
  background: white;
  padding: 40px;  /* Increased padding */
  box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
  border-radius: 10px;  /* Slight increase in border-radius */
  text-align: center;
  width: 500px;  /* Wider card */
}

.input-group {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1px;  /* More vertical spacing between input groups */
}

label {
  flex: 1;
  margin-right: 20px;
}

button {
  margin-top: 10px;
  padding: 5px 15px;
  font-size: 16px;  /* Increased font-size for the button */
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
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 10px;
  padding: 5px;
  border: 1px solid #ddd;
  border-radius: 5px;
  background-color: #f9f9f9;
}

input, select {
  flex: 2;
  display: block;
  width: 100%;
  margin: 10px 0;
  padding: 12px 8px; /* Increased padding for height and better spacing */
  font-size: 16px;   /* Bigger font size */
  border: 1px solid #ccc;
  border-radius: 4px;  /* Added for rounded corners */
}

/* You can add styles for specific input types if needed, e.g. */
input[type="text"], input[type="email"], input[type="password"] {
  height: 40px;  /* Fixed height for better control */
}

.password-wrapper {
  position: relative;
  width: 65%;
}

input[type="text"], input[type="email"], input[type="password"], select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box; /* This ensures that padding doesn't increase the total width */
}

.password-toggle-icon {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
}

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

