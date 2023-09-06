<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader :isAdmin="isAdmin"></UniHeader>
    </div>
    
        <!--Content-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <div class="registration-page">
            <h1>Bank Information</h1>
                <div class="data-box">

                <div class="input-group">
                <label for="fullname">Full Name:</label>
                <div class="statement-wrapper">
                    <input type="text" id="fullname" v-model="user.fullname">
                    <span class="asterisk1">*Refer to IC name</span>  <!-- The added asterisk -->
                </div>
                </div>
                
                <div class="input-group">
                <label for="bank">Bank:</label>
                <select id="bank" v-model="user.bank">
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
                    <input type="text" id="accctNo" v-model="user.accctNo">
                    <span class="asterisk2">*For verification purpose</span>  <!-- The added asterisk -->
                </div>
                </div>

                <div class="input-group">
                <label for="statement">Statement:</label>
                <div class="statement-wrapper">
                    <input type="text" id="statement" v-model="user.statement">
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

            <!-- Popup Modal -->
            <div v-if="showModal" class="modal">
              <div class="modal-content">
                <span @click="closeModal" class="close">&times;</span>
                Successfully Submitted!
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
      user: {
        fullname: '',
        bank: '',
        accctNo: '',
        statement: '',
      },
      showModal: false
    };
  },
  methods: {
    goBack() {
      // Navigate directly to the homepage
      this.$router.push({ path: '/registerPersonal' }); 
    },
    handleFile(event) {
      if (event.target.files && event.target.files[0]) {
        // Update the statement with the selected file's name
        this.user.statement = event.target.files[0].name;
      }
    },
    uploadstatement() {
      this.$refs.statementUpload.click();
    },
    submit() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.$router.push({ path: '/dashboard' }); 
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

.asterisk1 {
  position: absolute;
  color: red;
  margin-top:6.5vh;  /* Adjust this value if necessary to position the asterisk */
  font-size: 8px;  /* Adjust this value for the desired size of the asterisk */
}

.asterisk2 {
  position: absolute;
  color: red;
  margin-top:6.5vh;  /* Adjust this value if necessary to position the asterisk */
  font-size: 8px;  /* Adjust this value for the desired size of the asterisk */
}
.asterisk3 {
  position: absolute;
  color: red;
  margin-top:6.5vh;  /* Adjust this value if necessary to position the asterisk */
  font-size: 8px;  /* Adjust this value for the desired size of the asterisk */
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
