<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader :isAdmin="isAdmin"></UniHeader>
    </div>
    
        <!--Content-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <div class="deposit-page">
            <h1>Deposit Page</h1>
                <div class="data-box">

                <div class="input-group">
                  <label for="payform">Pay from</label>
                  <select id="favbank" v-model="transaction.bankAccountId">
                      <option v-for="bank in banks" :key="bank.bankAccount_id" :value="bank.bankAccount_id">
                          {{ bank.bankName }} - {{ bank.accountNo }}
                      </option>
                  </select>
                </div>

                <div class="input-group">
                <label for="payto">Pay To</label>
                <input type="text" id="accountNo" v-model="trading.accountNo" disabled>
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
  props: {
    isAdmin: Boolean,
  },
  data() {
    return {
      transaction: {
        accountNo: '',
        bankAccountId: '',
        tradingAccountId: '',
        amount: 0,
        transactionPurpose: '',
        currentBalance: 1000,
        status: 'pending',
        type: 'deposit'
      },
      trading: {
        tradingAccount_id: 1
      },
      banks: [],
      showModal: false
    };
  },
  mounted() {
    this.fetchAccountNo();
    this.fetchBankAccounts();
  },
  methods: {
    goBack() {
      // Navigate directly to the homepage
      this.$router.push({ path: '/' }); 
    },
    async submit() {
      let depositDetails = this.transaction;
        await this.$axios.post('/api/tradingAccount/transaction', depositDetails, {
                headers: {
                    Authorization: "Bearer " + this.$cookies.get('token')
                }
        })
        .then(function(response){
          console.log(response);
        })
        .catch(function(response){
          console.error(response);
        })

      this.showModal = true;
    },
    async fetchAccountNo() {
      await this.$axios.get('/api/tradingAccount/account/' + this.$cookies.get('user_id'), {
          headers: {
              Authorization: "Bearer " + this.$cookies.get('token')
          }
      })
      .then((response) => {
          this.transaction.accountNo = response.data.data.accountNo;
          this.transaction.tradingAccountId = response.data.data.tradingAccount_id;
          this.trading = response.data.data;
          console.log(this.trading);
      })
      .catch(function(response){
          console.error(response);
      });
    },
    async fetchBankAccounts() {
      await this.$axios.get('/api/bankAccount/accountByUser/' + this.$cookies.get('user_id'), {
          headers: {
              Authorization: "Bearer " + this.$cookies.get('token')
          }
      })
      .then((response) => {
          this.banks = response.data.data;
          console.log(this.banks);
      })
      .catch(function(error){
          console.error(error);
      });
    },
    closeModal() {
      this.showModal = false;
      this.$router.push({ path: '/' }); 
    },
    deposit() {
      // Perform deposit logic here
      // You can call an API or update the balance in your data store
      // Example: this.currentBalance += this.amount;

      // Reset the amount input field
      this.amount = 0;

      // Show success message or perform any other actions
      alert("Deposit successful!");
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

.error {
  color: red;
}

</style>