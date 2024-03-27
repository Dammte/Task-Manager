<template>
    <div class="navbar">
      <div class="navbar-left">
        <h2 class="title">TaskManager XY</h2>
      </div>
      <div class="navbar-right">
        <button @click="logout" class="logout-button">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      logout() {
        // Aquí iría la lógica para cerrar sesión
        console.log('Logout realizado');
      }
    }
  };
  </script>
  
  <style scoped>
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgb(245, 225, 184);
    color: black;
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    padding: 5px 10px;
    font-size: 16px;
  }
  
  .navbar h2.title {
    margin: 0;
    font-size: 20px;
    margin-left: 30px;
  }
  
  .logout-button {
    background-color: transparent;
    color: black;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
  }
  
  .logout-button i {
    margin-right: 5px;
  }
  </style>
  