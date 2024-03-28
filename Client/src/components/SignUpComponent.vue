<template>
    <div class="signup-container">
      <h2>Crear una cuenta</h2>
      <form class="signup-form" @submit.prevent="submitForm">
        <div class="form-group">
          <label for="name">Nombre de Usuario</label>
          <input type="text" id="name" v-model="name" placeholder="Ingresa un nombre de Usuario" required>
        </div>
        <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <input type="email" id="email" v-model="email" placeholder="Ingresa un correo electrónico" required>
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" v-model="password" placeholder="Ingresa una contraseña" required>
        </div>
        <button type="submit" class="signup-button">Registrarse</button>
      </form>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
      };
    },
    methods: {
    submitForm() {
      axios.post('http://127.0.0.1:8000/api/register', {
        name: this.name,
        email: this.email,
        password: this.password
      })
      .then(response => {
        console.log(response.data);
        // Aquí podrías redirigir al usuario a una página de inicio de sesión u otra página de tu aplicación
      })
      .catch(error => {
        console.error(error);
        // Aquí podrías mostrar un mensaje de error al usuario
      });
    }
  }
  };
  </script>
  
  <style scoped>
  .signup-container {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
  }
  
  h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }
  
  .signup-form {
    display: flex;
    flex-direction: column;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    font-weight: bold;
    color: #555;
  }
  
  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
  }
  
  button.signup-button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  button.signup-button:hover {
    background-color: #45a049;
  }
  
  </style>
  