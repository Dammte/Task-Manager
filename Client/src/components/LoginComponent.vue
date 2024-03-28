<template>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form class="login-form" @submit.prevent="login">
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" v-model="email" placeholder="Ingresa tu Correo electrónico" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" v-model="password" placeholder="Ingresa tu contraseña" required>
            </div>
            <button type="submit" class="login-button">Iniciar sesión</button>
        </form>
        <div>
            <a href="#" @click="openModal">¿Olvidaste tu contraseña?</a>
        </div>
        <div v-if="showModal" class="modal-overlay" @click="closeModal">
            <div class="modal-container" @click.stop>
                <div class="modal-header">
                    <h3>Recuperar Contraseña</h3>
                    <button class="close-button" @click.stop="closeModal">×</button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del modal -->
                    <p>Introduce tu correo electrónico para recuperar tu contraseña:</p>
                    <input type="email" v-model="recoveryEmail" placeholder="Correo Electrónico" required>
                    <button @click.prevent="recoverPassword" class="recover-button">Recuperar Contraseña</button>
                    <div v-if="recoveryMessage" class="recovery-message">{{ recoveryMessage }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            email: '',
            password: '',
            showModal: false,
            recoveryEmail: '',
            recoveryMessage: ''
        };
    },
    methods: {
        login() {
            axios.post('http://127.0.0.1:8000/api/login123', {
                email: this.email,
                password: this.password
            })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error.response.data);
                });
        },
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
            this.recoveryEmail = '';
            this.recoveryMessage = '';
        },
        recoverPassword() {
            axios.post('http://127.0.0.1:8000/forgot-password', {
                email: this.recoveryEmail
            })
            .then(response => {
                console.log(response.data);
                this.recoveryMessage = response.data.message;
            })
            .catch(error => {
                console.error(error.response.data);
                this.recoveryMessage = error.response.data.error;
            });
        }
    }
};
</script>

<style scoped>
.login-container {
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

.login-form {
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

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button.login-button {
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

button.login-button:hover {
    background-color: #45a049;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 60%;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.close-button {
    border: none;
    background-color: transparent;
    font-size: 16px;
    cursor: pointer;
}

.close-button:hover {
    color: #777;
}

.modal-body {
    font-size: 16px;
}

.recover-button {
    margin-top: 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.recover-button:hover {
    background-color: #45a049;
}

.recovery-message {
    margin-top: 10px;
    color: #333;
    font-size: 14px;
}
</style>
