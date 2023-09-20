<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader :isAdmin="isAdmin"></UniHeader>
    </div>
    
        <!--Content-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <div v-if='showUserDetails' class="registration-page">
            <h1>Registration</h1>
                <div class="data-box">

                <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" v-model="user.name">
                </div>

                <div class="input-group">
                <label for="address">Address:</label>
                <input type="text" id="address" v-model="user.address">
                </div>

                <div class="input-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" v-model="user.phoneNumber">
                </div>

                <div class="input-group">
                <label for="IC">IC:</label>
                <div class="ic-wrapper">
                    <input type="text" id="IC" v-model="user.IC">
                    <span class="asterisk">*File Name must be IC number</span>  <!-- The added asterisk -->
                    <input type="file" id="icUpload" ref="icUpload" @change="handleFile" style="display: none;">
                    <FileUpload mode="basic" name="demo[]" accept="image/*" :maxFileSize="1000000" @upload="uploadStatement" />-->
                </div>
                </div>
                

                <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="user.email">
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
                  <label for="password_confirmation">Confirm Password:</label>
                  <input type="password" id="password_confirmation" v-model="user.password_confirmation">
                    
                </div>

                <div class="input-group">
                <label for="gender">Gender:</label>
                <select id="gender" v-model="user.gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                </div>

                <div class="input-group">
                <label for="religion">Religion:</label>
                <select id="religion" v-model="user.religion">
                    <option value="Buddha">Buddha</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Islam">Islam</option>
                    <option value="Christian">Christian</option>
                    <option value="Others">Others</option>
                </select>
                </div>

                <div class="input-group">
                <label for="race">Race:</label>
                <select id="race" v-model="user.race">
                    <option value="chinese">Chinese</option>
                    <option value="malay">Malay</option>
                    <option value="indian">Indian</option>
                    <option value="Others">Others</option>
                </select>
                </div>

                <div class="button-group">
                    <button @click="goBack">Back</button>
                    <button @click="goToNextPage">Next</button>
                </div>
            </div>
        </div>
        <div v-else class="registration-page">
            <h1>Bank Information</h1>
                <div class="data-box">

                <div class="input-group">
                <label for="fullname">Full Name:</label>
                <div class="statement-wrapper">
                    <input type="text" id="fullname" v-model="account.accountName">
                    <span class="asterisk1">*Refer to IC name</span>  <!-- The added asterisk -->
                </div>
                </div>
                
                <div class="input-group">
                <label for="bank">Bank:</label>
                <select id="bank" v-model="account.bankName">
                    <option value="male">Maybank</option>
                    <option value="female">Public Bank</option>
                    <option value="male">Maybank</option>
                    <option value="female">OCBC Bank</option>
                    <option value="male">Hong Loeng</option>
                    <option value="female">UOB Bank</option>
                </select>
                </div>

                <div class="input-group">
                <label for="accctNo">Account No:</label>
                <div class="statement-wrapper">
                    <input type="text" id="accctNo" v-model="account.accountNo">
                    <span class="asterisk2">*For verification purpose</span>  <!-- The added asterisk -->
                </div>
                </div>

                <div class="input-group">
                  <label for="statement">Statement:</label>
                  <div class="statement-wrapper">
                      <input type="text" id="statement" v-model="account.bankStatement">
                      <span class="asterisk3">*Latest bank statement</span>  <!-- The added asterisk -->
                      <input type="file" id="statementUpload" ref="statementUpload" @change="handleFile" style="display: none;">
                      <button @click.prevent="uploadstatement">Upload</button>
                  </div>
                </div>
                
                <div class="button-group">
                    <button @click="goBack">Back</button>
                    <button @click="submit">Submit</button>
                </div>
            </div>

            
          </div>
          <!-- Popup Modal -->
          <div v-if="showModal" class="modal">
              <div class="modal-content">
                <span @click="closeModal('showModal')" class="close">&times;</span>
                Successfully Submitted!
              </div>
          </div>

          <!-- Error Modal -->
          <div v-if="showError" class="modal">
              <div class="modal-content">
                <span @click="closeModal('showError')" class="close">&times;</span>
                <div v-for="(value, key) in errorMessage">
                  <span>{{key}}: {{value[0]}}</span>
                </div>
              </div>
          </div>
</template>

<script>
export default {
  created() {
    if(this.isAdmin){
      this.user.userType = "admin";
      this.user.status = 'active';
      this.user.isVerified = true;
    }
    else{
      this.user.userType = "guest";
    }
  },
  props: {
    isAdmin: Boolean,
  },
  data() {
    return {
      user: {
        name: '',
        address: '',
        phoneNumber: '',
        IC: '',
        ICDocument: '',
        email: '',
        password: '',
        password_confirmation: '',
        gender: '',
        religion: '',
        race: '',
        userType: 'guest',
        status: 'pending',
        isVerified: false
      },
      account: {
        bankName: "",
        accountName: "",
        accountNo: "",
        bankStatement: "",
        status: "pending",
        userId: 0
      },
      response: null,
      showModal: false,
      showError: false,
      errorMessage: null,
      showPassword: false,
      showUserDetails: true,
      hasRegistered: false
    };
  },
  methods: {
    togglePassword() {
      this.showPassword = !this.showPassword;
    },
    async goBack() {
      // Navigate directly to the homepage
      if(this.showUserDetails && this.hasRegistered){
        await this.$axios.delete('/api/user/permentDelete/' + this.response.data.user.user_id,{
                headers: {
                    Authorization: "Bearer " + this.response.data.token
                }
        })
              .then(response => {
                this.$router.go(-1); 
              })
              .catch(error => {
                  console.log(error.response);
              });
        
      }
      else{
        this.showUserDetails = true;
      }
      
    },
    closeModal(modelName) {
      if(modelName == "showModal"){
        this.showModal = false;
        this.$router.push({ path: '/dashboard' }); 
      }
      else{
        this.showError = false;
      }
    },
    async goToNextPage() {
      // Navigate directly to the bank information
      if(!this.hasRegistered){
        this.user.ICDocument = this.user.IC + '.pdf';
        await this.$axios.post('/api/register', this.user)
              .then(response => {
                  this.response = response.data;
                  console.log(this.response);
                  this.showUserDetails = false;
                  this.hasRegistered = true;
              })
              .catch(error => {
                  this.errorMessage = error.response.data.data.errors;
                  console.log(this.errorMessage);
                  this.showError = true;
              });
        if(this.isAdmin){
          this.showModal = true;
        }
      }
      else{
        this.showUserDetails = false;
      }
      
    },
    async submit(){
      this.account.userId = this.response.data.user.user_id;
      this.account.bankStatement = this.account.accountNo + '.pdf';
      const tradingAccount = {
        userId: this.response.data.user.user_id
      }
        await this.$axios.post('/api/tradingAccount/account', tradingAccount, {
                headers: {
                    Authorization: "Bearer " + this.response.data.token
                }
        })
              .catch(error => {
                console.error(error);
              });

        await this.$axios.post('/api/bankAccount/account', this.account, {
                headers: {
                    Authorization: "Bearer " + this.response.data.token
                }
        })
              .then(response => {
                this.$cookies.set('isAuthorised', true);
                this.$cookies.set('user_id', this.response.data.user.user_id);
                this.$cookies.set('token', this.response.data.token);
                this.$cookies.set('isGuest', !this.response.data.user.isVerified);
                this.$cookies.set('userType', this.response.data.user.userType);
                this.showModal = true;
              })
              .catch(error => {
                  this.errorMessage = error.response.data.data.errors;
                  console.log(this.errorMessage);
                  this.showError = true;
              });
        await this.sleep(3000);
        this.$router.push({ path: '/dashboard' }); 
        
    },
    sleep(ms) {
    return new Promise(val => setTimeout(val, ms));
    },
    closeModal() {
      this.showModal = false;
      this.$router.push({ path: '/dashboard' }); 
    }
    /**handleFile(event) {
      if (event.target.files && event.target.files[0]) {
        // Update the IC with the selected file's name
        this.user.IC = event.target.files[0].name;
      }
    }*/,
    uploadStatement() {
      this.$refs.statementUpload.click();
    }
  }
}
</script>

<style scoped>
.registration-page {
  width: 400px;
  margin: 50px auto;
  font-family: 'Arial', sans-serif;
}

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

.IC-wrapper {
  display: flex;
  width: 100%;
  align-items: center;
}

.IC-wrapper input[type="text"] {
  flex-grow: 1;  /* It takes the maximum width available, pushing the button to the end. */
  margin-right: 10px; /* Some spacing between the input and the button */
}

.IC-wrapper button {
  width: 70px;       /* Set explicit width */
  text-align: center; 
  font-size: 14px;   /* Optional: Adjust font size if needed */
}

.password-wrapper {
  position: relative;
  width: 100%;
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

.asterisk {
  position: absolute;
  color: red;
  margin-top: 6.5vh;  /* Adjust this value if necessary to position the asterisk */
  left: 5;
  font-size: 8px;  /* Adjust this value for the desired size of the asterisk */
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