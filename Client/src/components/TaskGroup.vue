<template>
    <h1 style="text-align: center;">Task Group</h1>
    <div class="task-group">
    <div class="card">
      <div class="card-content">
        <h2>{{ groupName }}</h2>
        <div class="task-item-container">
          <TaskItem v-for="(task, index) in tasks" :key="index" :task="task" />
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import TaskItem from './TaskItem.vue';

export default {
    components: {
        TaskItem
    },
    props: {
        groupName: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            tasks: [
                {
                    "taskName": "Tarea 1",
                    "taskStatus": "Pendiente",
                    "taskDescription": "Descripción de la tarea 1"
                },
                {
                    "taskName": "Tarea 2",
                    "taskStatus": "En progreso",
                    "taskDescription": "Descripción de la tarea 2"
                },
                {
                    "taskName": "Tarea 3",
                    "taskStatus": "Completado",
                    "taskDescription": "Descripción de la tarea 3"
                },
                {
                    "taskName": "Tarea 4",
                    "taskStatus": "En Proceso",
                    "taskDescription": "Descripción de la tarea 4"
                },
                {
                    "taskName": "Tarea 5",
                    "taskStatus": "Bloqueada",
                    "taskDescription": "Descripción de la tarea 5"
                }
            ]
        };
    }
};
</script>


<style scoped>
.card {
    border: 2px solid black;
    border-radius: 8px;
    padding: 16px;
    margin: 16px;
}

.task-group {
    margin: 20px;
}

.task-group {
    margin-bottom: 20px;
    /* Espacio entre grupos */
}

.task-item-container {
    /* Estilos para contenedor de tareas */
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    /* Espacio entre las tarjetas de tarea */
}
</style>