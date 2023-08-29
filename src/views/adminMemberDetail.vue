<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <AdminHeader></AdminHeader>
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
            </div>
          </div>
        </div>







</template>

<script>
export default {
  props: ['id'], // you'd pass the member ID as a prop
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
      editMode: false,
      showPassword: false
    }
 //data() {
    //return {
      //member: {} // you'd populate this member data either from an API call or some store
    //};
  //},
  // mounted() {
  //   // As an example, fetch the member details from the members array
  //   const memberArray = [
  //     { id: 1, name: 'John Doe', funds: 1000 },
  //     { id: 2, name: 'Jane Smith', funds: 1500 },
  //     { id: 3, name: 'Robert Johnson', funds: 800 },
  //     { id: 4, name: 'John Smith', funds: 1500 },
  //     { id: 5, name: 'Kim Johnson', funds: 800 },
  //     { id: 6, name: 'Fisher Smith', funds: 1500 },
  //     { id: 7, name: 'James Johnson', funds: 800 },
  //     { id: 8, name: 'Kingsly Smith', funds: 1500 },
  //     { id: 9, name: 'Anna Johnson', funds: 800 },
  //     { id: 10, name: 'Oscar Smith', funds: 1500 },
  //     { id: 11, name: 'Tim Johnson', funds: 800 },
  //     { id: 12, name: 'Dawne Smith', funds: 1500 },
  //     { id: 13, name: 'Rock Johnson', funds: 800 }
  //   ];
    
  //   this.member = memberArray.find(m => m.id === parseInt(this.id));
  // }
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

