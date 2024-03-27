<template>
    <div class="navbar">
        <div class="navbar-left">
            <h2>TaskManager XY</h2>
        </div>
        <div class="navbar-right">
            <button @click="logout" class="logout-button">
                <i class="fas fa-user"></i> Logout
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
    background-color: #333;
    color: #fff;
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    padding: 5px 10px;
    /* Reducido el padding */
    font-size: 16px;
    /* Reducido el tamaño del texto */
}

.navbar h2 {
    margin: 0;
}

.navbar-right button {
    background-color: transparent;
    color: #fff;
    border: none;
    cursor: pointer;
}

.navbar-right button i {
    margin-right: 5px;
}

.logout-button {
    font-size: 16px;
}
</style>