<template>
    <div class="task-item" @click="openModal">
        <div :class="['task-item-card', task.status]">
            <div class="card-content">
                <p class="task-title task-name">{{ task.title }}</p>
                <div class="task-details">
                    <p class="task-detail">{{ task.responsable }}</p>
                    <p class="task-detail">{{ formattedDate(task.fechaLimite) }}</p>
                </div>
                <div class="task-actions">
                    <button @click.stop="editTask" class="edit-button">Editar</button>
                    <button @click.stop="deleteTask" class="delete-button">Eliminar</button>
                </div>
            </div>
        </div>
        <div v-if="showModal" class="modal-overlay" @click="closeModal">
            <div class="modal-container" @click.stop>
                <div class="modal-header">
                    <h3>Detalles de la tarea</h3>
                    <button @click.stop="closeModal" class="close-button">Cerrar</button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> {{ task.title }}</p>
                    <p><strong>Estado:</strong> {{ task.status }}</p>
                    <p><strong>Descripción:</strong> {{ task.description }}</p>
                    <p><strong>Responsable:</strong> {{ task.responsable }}</p>
                    <p><strong>Fecha Limite:</strong> {{ formattedDate(task.fechaLimite) }}</p>
                    
                    <!-- Agregar campo para cargar archivos -->
                    <input type="file" @change="handleFileUpload" multiple>
                    
                    <!-- Agregar campo para comentarios -->
                    <textarea v-model="comment" placeholder="Añadir comentarios"></textarea>
                
                    <button @click="saveImageOrDocument" class="save-button">Guardar</button>

                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import router from '@/router';
import { mapActions } from 'vuex';

export default {
    props: {
        task: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            showModal: false,
            comment: ''
        };
    },
    computed: {

    },
    methods: {
        ...mapActions(['setTaskToEdit']),
        editTask(event) {
            event.stopPropagation();
            console.log("Editar tarea:", this.task);
            this.setTaskToEdit(this.task);
            router.push({ name: 'edittask', params: { id: this.task.id } });
        },
        formattedDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('es-ES');
        },
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            console.log("Cerrando Modal")
            this.showModal = false;
        },
        deleteTask(event) {
            event.stopPropagation();
            console.log("Eliminar tarea:", this.task);

            axios.delete(`http://127.0.0.1:8000/api/tasks/${this.task.id}`)
                .then(response => {
                    console.log('Tarea eliminada:', response.data);
                    const index = this.$parent.tasks.findIndex(item => item.id === this.task.id);
                    if (index !== -1) {
                        this.$parent.tasks.splice(index, 1);
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar la tarea:', error);
                });
        },
        handleFileUpload(event) {
            const files = event.target.files;
            console.log("Archivos cargados:", files);
        }
    }
};
</script>

<style>
.task-details {
    display: flex;
    flex-direction: column;
    margin-top: 5px;
    text-align: center;
}

.task-detail {
    margin: 0;
    font-size: 14px;
}

.task-actions {
    margin-top: 10px;
}


.task-details {
    display: flex;
    flex-direction: column;
}

.task-detail {
    margin: 0;
    font-size: 14px;
}


.task-item {
    margin-bottom: 10px;
    width: 100%;
}

.task-item-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    transition: box-shadow 0.3s ease;
}

.task-item-card:hover {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.task-name {
    font-size: 24px;
    font-weight: bold;
    max-width: 70%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}


.task-title {
    margin: 0;
    font-size: 18px;
}

.task-actions {
    display: flex;
}

.delete-button {
    margin-left: 10px;
    padding: 8px 12px;
    border: none;
    background-color: lightcoral;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.edit-button {
    margin-left: 10px;
    padding: 8px 12px;
    border: none;
    background-color: rgb(243, 221, 124);
    color: black;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}


.edit-button:hover,
.delete-button:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Cambiado el valor de la sombra */
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

.close-button {
    border: none;
    background-color: transparent;
    font-size: 16px;
    cursor: pointer;
}

.close-button:hover {
    color: #777;
}

.modal-body {
    font-size: 16px;
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
    width: 80%; /* Cambiado a 80% para que sea más ancho */
    max-width: 600px; /* Establecido un ancho máximo */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Añadida una sombra */
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd; /* Línea separadora */
    padding-bottom: 10px; /* Espaciado inferior */
}

.close-button {
    border: none;
    background-color: transparent;
    font-size: 16px;
    cursor: pointer;
}

.close-button:hover {
    color: #777;
}

.modal-body {
    font-size: 16px;
}

.modal-body p {
    margin-bottom: 10px; /* Espaciado entre elementos */
}

.modal-body input[type="file"] {
    margin-bottom: 10px; /* Espaciado entre elementos */
}

.modal-body textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    resize: vertical; /* Permitir ajuste vertical */
    margin-bottom: 10px; /* Espaciado inferior */
}

.save-button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.save-button:hover {
    background-color: #45a049;
}
</style>