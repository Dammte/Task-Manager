<template>
  <div class="edit-task-form">
    <h2>Editar Tarea</h2>
    <form @submit.prevent="updateTask">
      <div class="form-group">
        <label for="title">Título:</label>
        <input type="text" id="title" v-model="editedTask.title" required>
      </div>
      <div class="form-group">
        <label for="description">Descripción:</label>
        <textarea id="description" v-model="editedTask.description" required></textarea>
      </div>
      <div class="form-group">
        <label for="status">Estado:</label>
        <select id="status" v-model="editedTask.status" required>
          <option value="en proceso">En Proceso</option>
          <option value="pendiente">Pendiente</option>
          <option value="bloqueado">Bloqueado</option>
          <option value="completado">Completado</option>
        </select>
      </div>
      <div class="form-group">
        <label for="assignee">Responsable:</label>
        <input type="text" id="assignee" v-model="editedTask.responsable" required>
      </div>
      <div class="form-group">
        <label for="due-date">Fecha Límite:</label>
        <input type="date" id="due-date" v-model="editedTask.fechaLimite" required>
      </div>
      <button type="submit">Actualizar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import router from '@/router';

export default {
  props: ['taskToEdit'],
  data() {
    return {
      editedTask: { ...this.taskToEdit }
    };
  },
  created() {
    const taskId = this.$route.params.id;
    if (taskId) {
      axios.get(`http://127.0.0.1:8000/api/tasks/${taskId}`)
        .then(response => {
          this.editedTask = response.data;
        })
        .catch(error => {
          console.error('Error al obtener la tarea:', error);
        });
    }
  },
  methods: {
    updateTask() {
      axios.put(`http://127.0.0.1:8000/api/tasks/${this.editedTask.id}`, this.editedTask)
        .then(response => {
          console.log('Tarea actualizada:', response.data);
          this.$router.push('/');
        })
        .catch(error => {
          console.error('Error al actualizar la tarea:', error);
        });
    }

  }
};
</script>

<style scoped>
.edit-task-form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border-radius: 8px;
  background-color: #f7f7f7;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-weight: bold;
  color: #555;
}

input[type="text"],
textarea,
select,
input[type="date"] {
  width: 100%;
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 6px;
  box-sizing: border-box;
}

select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url('data:image/svg+xml;utf8,<svg fill="%23333" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5H7z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
  background-repeat: no-repeat;
  background-position-x: calc(100% - 10px);
  background-position-y: center;
  padding-right: 30px;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  width: 100%;
  font-size: 16px;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #45a049;
}
</style>
