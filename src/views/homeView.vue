<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader :isAdmin="isAdmin"></UniHeader>
    </div>
    
        <!--Content-->
        <div class="container">
          <div class="bottom">


          <div class="panelAbout">
            <br><h1>About Us</h1><br>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/M%C3%BCnster%2C_LVM%2C_B%C3%BCrogeb%C3%A4ude_--_2013_--_5149-51.jpg/1024px-M%C3%BCnster%2C_LVM%2C_B%C3%BCrogeb%C3%A4ude_--_2013_--_5149-51.jpg" alt="About Us Image" class="about-image">
            <p class="aboutus">We are a forward-thinking company that prioritizes innovation, creativity, and customer satisfaction. We strive to provide top-quality service to all our users.</p>
          </div>

          <Divider type="solid" layout="vertical"/>
          
          <div class="panelLogin">
            
            <div class="profile-pic">
              <img :src="profilePicture" alt="Profile"/>
              </div>
              <form @submit.prevent="login" class="login-form">
                <div>
                  <label>Email:</label>
                  <input type="text" v-model="email" required>
                </div>
                <div>
                  <label>Password:</label>
                  <input type="password" v-model="password" required>
                </div>
                <Button label="SignIn" @click="login">Sign In</button>
                <Divider type="solid" layout="horizontal" > OR  </Divider>
                <Button label="SignUp" @click="goToRegister">Sign Up</button>
              </form>
            </div>

          </div>
        </div>

</template>

<script>

export default {
  props: {
    isAdmin: Boolean,
  },
  created(){
    if(this.$cookies.isKey('token') && this.$cookies.isKey('userType')){
      if(this.$cookies.get('userType') == 'member' || this.$cookies.get('userType') == 'guest'){
        this.$router.push('/dashboard');
      }
      else{
        this.$router.push('/admin/dashboard');
      }
    }
  },
  data() {
    return {
      email: "",
      password: "",
      profilePicture: "https://cdn-icons-png.flaticon.com/512/309/309543.png?w=740&t=st=1690356470~exp=1690357070~hmac=24a3543da4def732caecea92b8f231cb110c3d684b17d36e9f2a6d1f60af7fa9"
    };
  },
  computed: {
    isValidEmail() {
      return this.email.includes("@");
    },
    isValidPassword() {
      const passwordRegex = /^(?=.*\d)(?=.*[!@#$%^&*])\w{6,}$/;
      return passwordRegex.test(this.password);
    },
  },
  methods: {
    async login(e) {
      e.preventDefault();
      
      // Here you would typically send a request to your server to log the user in
      // For this example, we're just logging the username and password to the console
      let result = null;
      if(!this.$cookies.isKey('token')){
        console.log(`Logging in with username ${this.email} and password ${this.password}`);

        
        await this.$axios.post('/api/login', {
          email: this.email,
          password: this.password
        })
        .then(function(response){
          result = response.data;
        })
        .catch(function(response){
          console.error(response);
        })
        console.log(result);
        
        if((result != null)){
          this.$cookies.set('isAuthorised', true);
          this.$cookies.set('user_id', result.data.user.userId);
          this.$cookies.set('token', result.data.token);
          this.$cookies.set('isGuest', !result.data.userDetails[0].isVerified);
          this.$cookies.set('userType', result.data.userDetails[0].userType);
        }
        else{
          this.error = true;
          return;
        }
      }
      
      if(result.data.userDetails[0].userType == 'member' || result.data.userDetails[0].userType == 'guest'){
        return this.$router.push('/dashboard');
      }
      else{
        return this.$router.push('/admin/dashboard');
      }
      
    },
    goToRegister() {
      this.$router.push('/registerPersonal');
    },
  },
};
</script>

<style scoped>

.bottom {
            display: flex;
            flex-direction: row;
            flex: 1;
        }

.panelAbout {
            
            width: 50%;
        }

.panelLogin {
  display: flex;
  flex-direction: column;
  align-items: center;
  border: 1px solid rgb(196, 186, 186);
  padding: 20px;
  width: 300px;
  margin: auto;
  margin-top: 160px;
  margin-bottom: 210px;
}

.profile-pic img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
}

.login-form{
  width: 100%;
}
.panelLogin input {
  display: block;
  margin-bottom: 10px;
  padding: 5px;
  width: 100%;
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

.aboutus {
  bottom: 295px;  /* Adjust this value if necessary to position the asterisk */
  left: 5;
  /* Adjust this value for the desired size of the asterisk */
}

/* Style for the About Us image */
.about-image {
    width: 100%; /* This will ensure the image takes up the full width of its container */
    height: auto; /* This will ensure the image scales proportionally */
    margin-bottom: 20px; /* Some space between the image and the paragraph */
}

.red{
  color: red;
  font-size: small;
}
</style>