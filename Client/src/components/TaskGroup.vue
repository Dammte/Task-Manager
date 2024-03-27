<template>
    <div class="task-group">
        <div class="card">
            <div class="card-content">
                <h2>{{ groupName }}</h2>
                <div class="task-item-container" style="height: 380px; overflow-y: auto;">
                    <TaskItem v-for="(task, index) in tasks" :key="index" :task="task" />
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import TaskItem from './TaskItem.vue';
import axios from 'axios';

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
            tasks: []
        };
    },
    mounted() {
        axios.get('http://127.0.0.1:8000/api/tasks')
            .then(response => {
                console.log('Datos recibidos de la API:', response.data); // Imprimir los datos recibidos de la API en la consola
                // Comprueba si los datos son un array y no están vacíos antes de asignarlos
                if (Array.isArray(response.data) && response.data.length > 0) {
                    // Asigna los datos a la propiedad tasks
                    this.tasks = response.data;
                } else {
                    console.warn('La respuesta de la API no contiene datos válidos.');
                }
            })
            .catch(error => {
                console.error('Error al obtener las tareas:', error);
            });
    }

};
</script>

<style scoped>
.card {
    border: 1px solid black;
    border-radius: 8px;
    padding: 16px;
    margin: 16px;
}

.task-group {
    margin: 40px;
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
