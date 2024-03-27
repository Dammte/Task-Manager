<template>
    <div class="task-item" @click="openModal">
        <div class="card task-item-card">
            <div class="card-content">
                <p><strong>{{ task.title }}</strong></p>
            </div>
            <div class="card-actions">
                <button @click.stop="editTask" class="edit-button">Editar</button>
                <button @click.stop="deleteTask" class="delete-button">Eliminar</button>
            </div>
        </div>
        <!-- Modal -->
        <div v-if="showModal" class="modal-overlay">
            <div class="modal-container">
                <div class="modal-header">
                    <h3>Detalles de la tarea</h3>
                    <button @click="closeModal">Cerrar</button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> {{ task.title }}</p>
                    <p><strong>Estado:</strong> {{ task.status }}</p>
                    <p><strong>Descripción:</strong> {{ task.description }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import router from '@/router';

export default {
    props: {
        task: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            showModal: false
        };
    },
    methods: {
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            console.log("Cerrando Modal")
            this.showModal = false;

        },
        editTask(event) {
            event.stopPropagation();
            console.log("Editar tarea:", this.task);

            // Redirige a la ruta deseada
            router.push(`/edittask/${this.task.id}`);
        },

        deleteTask(event) {
            event.stopPropagation();
            console.log("Eliminar tarea:", this.task);

            axios.delete(`http://127.0.0.1:8000/api/tasks/${this.task.id}`)
                .then(response => {
                    console.log('Tarea eliminada:', response.data);
                    // Elimina la tarea de la lista de tareas
                    const index = this.$parent.tasks.findIndex(item => item.id === this.task.id);
                    if (index !== -1) {
                        this.$parent.tasks.splice(index, 1);
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar la tarea:', error);
                });
        }

    }
};
</script>

<style>
.task-item {
    margin-bottom: 10px;
    width: 100%;
    cursor: pointer;
}

.task-item-card {
    border: 2px solid black;
    border-radius: 8px;
    padding: 10px;
    width: 100%;
}

.card {
    text-align: center;
    width: 100%;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 60%;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.card-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.edit-button,
.delete-button {
    margin-left: 10px;
    padding: 5px 10px;
    border: none;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    border-radius: 5px;
}

.edit-button:hover,
.delete-button:hover {
    background-color: #0056b3;
}
</style>