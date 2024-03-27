<template>
  <h1 style="text-align: center;">ActionsComponent</h1>
    <div class="actions-card">
    <div class="card">
      <div class="card-content">
        <div class="filter-buttons">
          <button class="button-new" @click="addNewTask()"><i class="fas fa-plus"></i> Nuevo</button>
          <button class="in-process" @click="filterTasks('en proceso')">En Proceso</button>
          <button class="pending" @click="filterTasks('pendiente')">Pendiente</button>
          <button class="blocked" @click="filterTasks('bloqueado')">Bloqueado</button>
          <button class="completed" @click="filterTasks('completado')">Completado</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import router from '@/router';

export default {
  methods: {
    addNewTask() {
      // Lógica para agregar una nueva tarea
      console.log('Nueva tarea agregada');

      router.push(`/newtask`);
    },
    filterTasks(filterType) {
      // Lógica para filtrar tareas según el tipo
      console.log('Filtrar tareas por:', filterType);
    }
  }
};
</script>

<style scoped>
.actions-card {
  width: 100%; /* Ocupa todo el ancho disponible */
}

.filter-buttons {
  margin-top: 10px;
  display: flex;
  flex-direction: column;
}

.filter-buttons button {
  margin-bottom: 5px;
  height: 40px;
  border-radius: 10px;
  margin: 5px;
  cursor: pointer;
}

.button-new{
  background-color: lightskyblue;
}

.in-process {
  background-color: #FFD700; /* Amarillo */
}

.pending {
  background-color: #FF6347; /* Rojo */
}

.blocked {
  background-color: lightgray; /* Gris */
}

.completed {
  background-color: #32CD32; /* Verde */
}
</style>