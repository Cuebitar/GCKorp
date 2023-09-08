<template>
    <div class="p-d-flex p-jc-center p-ai-center" style="height: 100vh;">
      <div class="p-text-center">
        <h1 class="p-text-danger" style="font-size: 6rem;">404</h1>
        <h4 style="font-size: 2rem;">Page not found</h4>
        <p style="font-size: 1.5rem;">The page you are looking for does not exist.</p>
        <router-link to="/" class="p-button p-button-primary" style="font-size: 1.2rem;">
          Go back to the home page
        </router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Error404',
  };
  </script>
  
  <style scoped>
  /* Center the content vertically and horizontally */
  .p-d-flex {
    justify-content: center;
    align-items: center;
  }
  
  /* Add a background color */
  body {
    background-color: #f4f4f4;
  }
  
  /* Style the error message */
  .p-text-danger {
    color: #ff5733; /* Red color for the error message */
  }
  
  /* Style the "Go back" button */
  .p-button {
    background-color: #007ad9; /* Blue color for the button */
    color: #fff; /* White text color */
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .p-button:hover {
    background-color: #0056b3; /* Darker blue color on hover */
  }
  </style>
  