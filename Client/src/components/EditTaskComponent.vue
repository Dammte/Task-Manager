<template>
  <div class="edit-task-form">
    <h1 style="text-align: center;">Editar Tarea</h1>
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

export default {
  props: ['taskToEdit'],
  data() {
    return {
      editedTask: { ...this.taskToEdit }
    };
  },
  created() {
    // Recupera el ID de la tarea de los parámetros de la ruta en la URL
    const taskId = this.$route.params.id;
    if (taskId) {
      axios.get(`http://127.0.0.1:8000/api/tasks/${taskId}`)
        .then(response => {
          // Inicializa el formulario con los datos de la tarea recuperados
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
          // Aquí podrías emitir un evento o realizar otras acciones necesarias después de la actualización exitosa
        })
        .catch(error => {
          console.error('Error al actualizar la tarea:', error);
          // Aquí podrías manejar el error de alguna manera, por ejemplo, mostrando un mensaje al usuario
        });
    }

  }
};
</script>

<style scoped>
.edit-task-form {
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
