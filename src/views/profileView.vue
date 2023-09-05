<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader></UniHeader>
    </div>
    
        <!--Content-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <div class="profile-page">
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
              <button @click="editMode = true">Edit Profile</button>
            </div>
          </div>

          <div v-if="editMode">
            <h1>Personal Information</h1>
            <div class="profile-card">
              <input v-model="user.username" placeholder="Username" disabled>
              <input v-model="user.address" placeholder="Address">
              <input v-model="user.phoneNumber" placeholder="Phone Number">
              <input v-model="user.icNumber" placeholder="IC" disabled>
              <input type="email" v-model="user.email" placeholder="Email">
              <input type="password" v-model="user.password" placeholder="Password">
              <input type="password" v-model="user.passwordConfirmation" placeholder="Password Confirmation">
              <select v-model="user.gender">
                <option value="" disabled selected>Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
              <select v-model="user.religion">
                <option value="" disabled selected>Religion</option>
                <option value="buddha">Buddha</option>
                <option value="hindu">Hindu</option>
                <option value="islam">Islam</option>
                <option value="christian">Christian</option>
                <option value="other">Other</option>
              </select>
              <select v-model="user.race">
                <option value="" disabled selected>Race</option>
                <option value="buddha">Chinese</option>
                <option value="hindu">Malay</option>
                <option value="islam">Indian</option>
                <option value="other">Other</option>
              </select>
              <button @click="saveChanges">Save Changes</button>
            </div>
          </div>

            <!-- Popup Modal -->
            <div v-if="showModal" class="modal">
              <div class="modal-content">
                <span @click="closeModal" class="close">&times;</span>
                Successfully Updated!
              </div>
            </div>
            
        </div>
</template>




<script>
export default {
  data() {
    return {
      user: {
        username: "JohnDoe123",
        address: "",
        phoneNumber: "",
        ic: "1234567890",
        email: "",
        password: "",
        passwordConfirmation: "",
        gender: "",
        religion: "",
        race: ""
        
      },
      editMode: false,
      showPassword: false,
      showModal: false
    };
  },
  methods: {
    togglePassword() {
      this.showPassword = !this.showPassword;
    },
    saveChanges() {
      // Usually, you would send the updated user data to your server
      // For this example, we just log the changes
      console.log("User data updated:", this.user);
      this.editMode = false;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
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

.profile-page {
  display: flex;
  justify-content: center;
  align-items: flex-start; /* Aligns items to the start of the container */
  height: 100vh;
  background-color: #f5f5f5;
  font-size: 18px;
  padding-top: 20px; /* Pushes the content down from the top */
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
  background-color: rgba(0,0,0,0.4); /* Slight transparency to darken the background */
}

/* Modal Content Box */
.modal-content {
  background-color: #fefefe;
  padding: 20px;
  border: 1px solid #888;
  width: 200px;       /* Set the width to your desired size */
  height: 150px;      /* Make the height equal to the width for a square shape */
  text-align: center;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  position: relative;
  display: flex;      /* Added flex properties to center the content */
  justify-content: center;
  align-items: center;
}


/* The Close Button */
.close {
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
  position: absolute;
  top: 5px;
  right: 15px;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
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

</style>