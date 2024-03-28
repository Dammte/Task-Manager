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
  import axios from 'axios';

  export default {
    methods: {
      logout() {
        axios.post('http://127.0.0.1:8000/api/logout')
          .then(response => {
            console.log('Logout realizado');
            this.$router.push('/login');
          })
          .catch(error => {
            console.error('Error al intentar cerrar sesión:', error);
          });
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
  font-size: 23px;
  margin-left: 70px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px; 
  color: #333; 
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
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
  