<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader :isAdmin="isAdmin"></UniHeader>
    </div>

        <!--Content-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <div class="container">
        <section>
            <div v-if="!editMode">
              <h1>Personal Information</h1>
              <div class="profile-card">
                <div class="input-group">
                  <label for="username">Username:</label>
                  <input id="username" v-model="user.username" disabled>
                </div>
                <div class="input-group">
                  <label for="address">Address:</label>
                  <input id="address" v-model="user.address" disabled>
                </div>
                <div class="input-group">
                  <label for="phoneNumber">Phone Number:</label>
                  <input id="phoneNumber" v-model="user.phoneNumber" disabled>
                </div>
                <div class="input-group">
                  <label for="ic">IC:</label>
                  <input id="ic" v-model="user.ic" disabled>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <div class="password-wrapper">
                        <input :type="showPassword ? 'text' : 'password'" id="password" v-model="user.password">
                        <i class="fas fa-eye password-toggle-icon" @click="togglePassword" v-if="!showPassword"></i>
                        <i class="fas fa-eye-slash password-toggle-icon" @click="togglePassword" v-else></i>
                    </div>
                </div>
                <div class="input-group">
                  <label for="email">Email:</label>
                  <input id="email" v-model="user.email" disabled>
                </div>
                <div class="input-group">
                  <label for="gender">Gender:</label>
                  <input id="gender" v-model="user.gender" disabled>
                </div>
                <div class="input-group">
                  <label for="religion">Religion:</label>
                  <input id="religion" v-model="user.religion" disabled>
                </div>
                <div class="input-group">
                  <label for="race">Race:</label>
                  <input id="race" v-model="user.race" disabled>
                </div>
              </div>
            </div>
        </section>

          <!-- Bank Account in Card Design -->
          <section>
              <!-- Comment for Bank Account Section -->
              <h1>Bank Account Information</h1>

              <!-- Account 1 -->
              <div class="bank-account-card">
                  <h3>Account 1</h3>
                  <div class="input-group">
                      <label for="account1Username">Account Username:</label>
                      <input id="account1Username" type="text" v-model="bankAccounts.account1.username">
                  </div>
                  <div class="input-group">
                      <label for="account1BankName">Bank Name:</label>
                      <input id="account1BankName" type="text" v-model="bankAccounts.account1.bank">
                  </div>
                  <div class="input-group">
                      <label for="account1Number">Account Number:</label>
                      <input id="account1Number" type="text" v-model="bankAccounts.account1.number">
                  </div>
              </div>

              <!-- Account 2 -->
              <div class="bank-account-card">
                  <h3>Account 2</h3>
                  <div class="input-group">
                      <label for="account2Username">Account Username:</label>
                      <input id="account2Username" type="text" v-model="bankAccounts.account2.username">
                  </div>
                  <div class="input-group">
                      <label for="account2BankName">Bank Name:</label>
                      <input id="account2BankName" type="text" v-model="bankAccounts.account2.bank">
                  </div>
                  <div class="input-group">
                      <label for="account2Number">Account Number:</label>
                      <input id="account2Number" type="text" v-model="bankAccounts.account2.number">
                  </div>
              </div>

              <!-- Account 3 -->
              <div class="bank-account-card">
                  <h3>Account 3</h3>
                  <div class="input-group">
                      <label for="account3Username">Account Username:</label>
                      <input id="account3Username" type="text" v-model="bankAccounts.account3.username">
                  </div>
                  <div class="input-group">
                      <label for="account3BankName">Bank Name:</label>
                      <input id="account3BankName" type="text" v-model="bankAccounts.account3.bank">
                  </div>
                  <div class="input-group">
                      <label for="account3Number">Account Number:</label>
                      <input id="account3Number" type="text" v-model="bankAccounts.account3.number">
                  </div>
              </div>
          </section>
        
          <!-- Trading Account Information -->
          <section>
              <!-- Comment for Trading Account Information -->
              <h1>Trading Account Information</h1>
              <div class="trading-account-card">
                  <!-- Trading Number Input -->
                  <div class="input-group">
                      <label for="tradingNumber">Trading Number:</label>
                      <input id="tradingNumber" type="text" v-model="tradingAccount.tradingNumber">
                  </div>
                  <!-- Amount Input -->
                  <div class="input-group">
                      <label for="amount">Amount:</label>
                      <input id="amount" type="text" v-model="tradingAccount.amount">
                  </div>
                  
                  <!-- Status Input -->
                  <div class="input-group">
                      <label for="status">Status:</label>
                      <input id="status" type="text" v-model="tradingAccount.status">
                  </div>
              </div>
            </section>
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
      user: {
        username: "JohnDoe123",
        address: "123, Taman Rose, Jalan Jasmine, 41200, Selangor, Malaysia.",
        phoneNumber: "01678912345",
        ic: "701050502698",
        email: "johndoe@gmail.com",
        password: "123456789",
        gender: "Male",
        religion: "Buddha",
        race: "Chinese"
      },
       tradingAccount: {
        tradingNumber: "123-456-789",
        amount: "MYR 30000.00",
        status: "Active"
      },
      bankAccounts: {
        account1: {
          username: "John Liu Kang Ling",
          bank: "Maybank",
          number: "123456789"
        },
        account2: {
          username: "Jonathan Fisher",
          bank: "Maybank",
          number: "789546123"
        },
        account3: {
          username: "Sherly Mick",
          bank: "Maybank",
          number: "456123789"
        }
      },
      editMode: false,
      showPassword: false
    };
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

.profile-card {
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

.bank-account-card, .trading-account-card {
  background: white;
  padding: 40px;
  box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
  border-radius: 10px;
  text-align: center;
  width: 500px;
  margin-top: 30px;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column; /* Stacks the cards vertically */
  gap: 20px; /* Provides spacing between vertically stacked items */
  background: #f5f5f5;
}

</style>

