<template>
  <div class="actions-container">
    <div class="actions-buttons">
      <button class="action-button new-task" @click="addNewTask"><i class="fas fa-plus"></i> Nueva Tarea</button>
      <button class="action-button yellow" @click="filterTasks('en proceso')">En Proceso</button>
      <button class="action-button red" @click="filterTasks('pendiente')">Pendiente</button>
      <button class="action-button gray" @click="filterTasks('bloqueado')">Bloqueado</button>
      <button class="action-button green" @click="filterTasks('completado')">Completado</button>
    </div>
  </div>
</template>

<script>
import router from '@/router';

export default {
  methods: {
    addNewTask() {
      console.log('Nueva tarea agregada');
      router.push(`/newtask`); // Redirige al usuario a la ruta '/nueva-tarea'
    },
    filterTasks(filterType) {
      console.log('Filtrar tareas por:', filterType);
    }
  }
};
</script>

<style scoped>
.actions-container {
  text-align: center;
  margin-bottom: 20px;
}

.actions-title {
  font-size: 30px;
  margin-bottom: 10px;
}

.actions-buttons {
  display: flex;
  flex-direction: column; /* Cambio a columna */
  align-items: center;
  margin-top: 40px;
}

.action-button {
  margin: 5px;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  border: none;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.action-button i {
  margin-right: 5px;
}

.yellow {
  background-color: #FFD700; /* Amarillo */
}

.red {
  background-color: #FF6347; /* Rojo */
}

.gray {
  background-color: lightgray; /* Gris */
}

.green {
  color: black;
  background-color: lightgreen; /* Verde */
}

.new-task {
  margin-bottom: 50px;
  background-color: lightskyblue;
}
</style>
