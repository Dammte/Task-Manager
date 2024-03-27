<template>
    <h1 style="text-align: center;">ActionsComponent</h1>
    <div class="actions-card">
    <div class="card">
      <div class="card-content">
        <button @click="addNewTask">Nuevo</button>
        <div class="filter-buttons">
          <button @click="filterTasks('en proceso')">En Proceso</button>
          <button @click="filterTasks('pendiente')">Pendiente</button>
          <button @click="filterTasks('bloqueado')">Bloqueado</button>
          <button @click="filterTasks('completado')">Completado</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    addNewTask() {
      // Lógica para agregar una nueva tarea
      console.log('Nueva tarea agregada');
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
  flex-direction: column; /* Apilar botones verticalmente */
}

.filter-buttons button {
  margin-bottom: 5px; /* Espacio entre botones */
}
</style>