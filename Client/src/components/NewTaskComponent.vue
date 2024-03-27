<template>
  <div class="new-task-form">
    <h1 style="text-align: center;">Nueva Tarea</h1>
    <form @submit.prevent="addNewTask()">
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
        <label for="assignee">Responsable:</label>
        <input type="text" id="assignee" v-model="task.responsable" required>
      </div>
      <div class="form-group">
        <label for="due-date">Fecha Límite:</label>
        <input type="date" id="due-date" v-model="task.fechaLimite" required>
      </div>
      <button type="submit">Guardar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

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
      axios.post('http://127.0.0.1:8000/api/tasks', this.task) // Aquí asumimos que la URL '/api/tasks' maneja la creación de nuevas tareas
        .then(response => {
          console.log('Tarea guardada exitosamente:', response.data);
          // Puedes redirigir al usuario a otra página después de guardar la tarea si es necesario
          this.$router.push('/');
        })
        .catch(error => {
          console.error('Error al guardar la tarea:', error);
        });
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
