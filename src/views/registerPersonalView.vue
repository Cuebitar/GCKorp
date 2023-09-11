<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader></UniHeader>
    </div>
    
        <!--Content-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <div class="registration-page">
            <h1>Registration</h1>
                <div class="data-box">

                <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" v-model="user.username" @input="validateUsername">
                <span v-if="usernameError" class="error">{{ usernameError }}</span>
                </div>

                <div class="input-group">
                <label for="address">Address:</label>
                <input type="text" id="address" v-model="user.address">
                </div>

                <div class="input-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" v-model="user.phoneNumber" @input="validatePhone">
                <span v-if="phoneError" class="error">{{ phoneError }}</span>
                </div>

                <div class="input-group">
                <label for="IC">IC:</label>
                <div class="ic-wrapper">
                    <input type="text" id="IC" v-model="user.ic" input="validateIC" >
                    <span class="asterisk">*File Name must be IC number</span>  <!-- The added asterisk -->
                    <span v-if="icError" class="error">{{ icError }}</span>
                    <input type="file" id="icUpload" ref="icUpload" @change="handleFile" style="display: none;">
                    <button @click.prevent="uploadIC">Upload</button>
                </div>
                </div>
                

                <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="user.email" @input="validateEmail">
                <span v-if="emailError" class="error">{{ emailError }}</span>
                </div>

                <div class="input-group">
                    <label for="password">Password:</label>
                    <div class="password-wrapper">
                        <input :type="showPassword ? 'text' : 'password'" id="password" v-model="user.password" @input="validatePassword">
                        <span v-if="passwordError" class="error">{{ passwordError }}</span>
                        <i class="fas fa-eye password-toggle-icon" @click="togglePassword" v-if="!showPassword"></i>
                        <i class="fas fa-eye-slash password-toggle-icon" @click="togglePassword" v-else></i>
                    </div>
                </div>

                <div class="input-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" v-model="user.confirmPassword">
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
                <input type="text" id="race" v-model="user.race">
                </div>
                
                <div class="button-group">
                    <button @click="goBack">Back</button>
                    <button @click="goToNextPage">Next</button>
                </div>
            </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        username: '',
        address: '',
        phoneNumber: '',
        ic: '',
        email: '',
        password: '',
        confirmPassword: '',
        gender: '',
        religion: '',
        race: ''
      },
      showPassword: false
    };
  },
  methods: {
    togglePassword() {
      this.showPassword = !this.showPassword;
    },
    goBack() {
      // Navigate directly to the homepage
      this.$router.go(-1); 
    },
    goToNextPage() {
      // Navigate directly to the bank information
      this.$router.push({ path: '/registerBank' }); 
    },
    handleFile(event) {
      if (event.target.files && event.target.files[0]) {
        // Update the ic with the selected file's name
        this.user.ic = event.target.files[0].name;
      }
    },
    uploadStatement() {
      this.$refs.statementUpload.click();
    },
    validateUsername() {
      if (!/\d/.test(this.user.username)) {
        this.usernameError = "Username must include a number.";
      } else {
        this.usernameError = "";
      }
    },
    validateEmail() {
      if (!this.user.email.includes("@")) {
        this.emailError = "Email must include @.";
      } else {
        this.emailError = "";
      }
    },
    validatePassword() {
      if (!/\d/.test(this.user.password) || !/[!@#$%^&*]/.test(this.user.password)) {
        this.passwordError = "Password must include at least one number and symbol.";
      } else {
        this.passwordError = "";
      }
    },
    validatePhone() {
      if (!this.user.phoneNumber.includes("-")) {
        this.phoneError = "Phone number must include a dash.";
      } else {
        this.phoneError = "";
      }
    },
     validateIC() {
      if (!this.user.ic.includes("-")) {
        this.icError = "IC must include a dash.";
      } else {
        this.icError = "";
      }
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

.ic-wrapper {
  display: flex;
  width: 100%;
  align-items: center;
}

.ic-wrapper input[type="text"] {
  flex-grow: 1;  /* It takes the maximum width available, pushing the button to the end. */
  margin-right: 10px; /* Some spacing between the input and the button */
}

.ic-wrapper button {
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

.error {
  color: red;
}

</style>
