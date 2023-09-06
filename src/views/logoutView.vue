<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader :isAdmin="isAdmin"></UniHeader>
    </div>
    
        <!--Content-->
        <div class="logout-page">
            <h1>You've been logged out</h1>
            <p>Thank you for using our service. We hope to see you again soon!</p>
            <button @click="goToLogin">Home</button>
        </div>

</template>


<script>
export default {
  props: {
    isAdmin: Boolean,
  },
  methods: {
    goToLogin() {
      this.$isAuthorised = false;
      this.$isGuest = true;
      this.$router.push('/');
    }
  }
}
</script>

<style scoped>
.logout-page {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  font-family: 'Arial', sans-serif;
}

h1 {
  font-size: 24px;
  margin-bottom: 10px;
}

p {
  font-size: 18px;
  margin-bottom: 20px;
}

button {
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  background-color: #007BFF;
  color: #FFFFFF;
  border: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;

}

button:hover {
  background-color: #0056b3;
}
</style>