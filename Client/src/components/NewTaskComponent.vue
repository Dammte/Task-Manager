<template>
  <div class="new-task-form">
    <h1 style="text-align: center;">Nueva Tarea</h1>
    <form @submit.prevent="addNewTask">
      <div class="form-group">
        <label for="title">Título:</label>
        <input type="text" id="title" v-model="task.title" required>
      </div>
      <div class="form-group">
        <label for="description">Descripción:</label>
        <textarea id="description" v-model="task.description" required></textarea>
      </div>
      <div class="form-group">
        <label for="status">Estado:</label>
        <select id="status" v-model="task.status" required>
          <option value="en proceso">En Proceso</option>
          <option value="pendiente">Pendiente</option>
          <option value="bloqueado">Bloqueado</option>
          <option value="completado">Completado</option>
        </select>
      </div>
      <div class="form-group">
        <label for="assignee">Encargado:</label>
        <input type="text" id="assignee" v-model="task.assignee" required>
      </div>
      <div class="form-group">
        <label for="due-date">Fecha Límite:</label>
        <input type="date" id="due-date" v-model="task.dueDate" required>
      </div>
      <button type="submit">Guardar</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      task: {
        title: '',
        description: '',
        status: 'en proceso',
        assignee: '',
        dueDate: ''
      }
    };
  },
  methods: {
    addNewTask() {
      // Aquí puedes manejar la lógica para guardar la nueva tarea
      console.log('Nueva tarea:', this.task);
    }
  }
};
</script>

<style scoped>
.new-task-form {
  max-width: 400px;
  margin: 0 auto;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-weight: bold;
}

input[type="text"],
textarea,
select,
input[type="date"] {
  width: 100%;
  padding: 8px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
  font-size: 16px;
}

button:hover {
  background-color: #45a049;
}
</style>
