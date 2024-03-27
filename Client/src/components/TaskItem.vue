<template>
    <div class="task-item" @click="openModal">
        <div class="card task-item-card">
            <div class="card-content">
                <p><strong>{{ task.taskName }}</strong></p>
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
                    <p><strong>Nombre:</strong> {{ task.taskName }}</p>
                    <p><strong>Estado:</strong> {{ task.taskStatus }}</p>
                    <p><strong>Descripción:</strong> {{ task.taskDescription }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

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
</style>