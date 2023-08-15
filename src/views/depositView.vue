<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader></UniHeader>
    </div>
    
        <!--Content-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <div class="deposit-page">
            <h1>Deposit Page</h1>
                <div class="data-box">

                <div class="input-group">
                <label for="payform">Pay from</label>
                <select id="favbank" v-model="transaction.bankAccountId">
                    <option value="favbank">Fav1</option>
                    <option value="favbank">Fav2</option>
                    <option value="favbank">Fav3</option>
                    <option value="favbank">Fav4</option>
                    <option value="favbank">Fav5</option>
                    
                </select>
                </div>

                <div class="input-group">
                <label for="payto">Pay To</label>
                <select id="tradacc" v-model="transaction.tradingAccountId">
                    <option value="trad">Trad1</option>
                    <option value="trad">Trad2</option>
                    <option value="trad">Trad3</option>
                    <option value="trad">Trad4</option>
                    <option value="trad">Trad5</option>
                </select>
                </div>

                <div class="input-group">
                <label for="depositAmount">Amount (MYR)</label>
                <input type="text" id="amountdep" v-model="transaction.amount">
                </div>

                <div class="input-group">
                <label for="transactionPurpose">Purpose:</label>
                <input type="text" id="transactionPurpose" v-model="transaction.transactionPurpose">
                </div>

                <div class="button-group">
                    <button @click="submit">Submit</button>
                </div>
            </div>

            <!-- Popup Modal -->
            <div v-if="showModal" class="modal">
              <div class="modal-content">
                <span @click="closeModal" class="close">&times;</span>
                Transaction Successful
              </div>
            </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      transaction: {
        bankAccountId: '',
        tradingAccountId: '',
        amount: '',
        transactionPurpose: '',
      },
      showModal: false
    };
  },
  methods: {
    goBack() {
      // Navigate directly to the homepage
      this.$router.push({ path: '/' }); 
    },
    submit() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.$router.push({ path: '/' }); 
    }
  }
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