<template>
    <div class="task-group">
        <div class="card search-card">
            <div class="card-content">
                <h2>{{ groupName }}</h2>
                <input type="text" v-model="searchQuery" @input="searchTasks" placeholder="Buscar tarea..." class="search-box">
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="task-item-container" style="height: 325px; overflow-y: auto;">
                    <TaskItem v-for="(task, index) in filteredTasks" :key="index" :task="task" />
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
            tasks: [],
            filterType: null,
            searchQuery: ''
        };
    },
    computed: {
        filteredTasks() {
            let filteredTasks = this.tasks;
            if (this.filterType) {
                filteredTasks = filteredTasks.filter(task => task.estado === this.filterType);
            }
            if (this.searchQuery.trim() !== '') {
                const searchTerm = this.searchQuery.trim().toLowerCase();
                filteredTasks = filteredTasks.filter(task => task.nombre.toLowerCase().includes(searchTerm));
            }
            return filteredTasks;
        }
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        fetchTasks() {
            axios.get('http://127.0.0.1:8000/api/tasks')
                .then(response => {
                    console.log('Datos recibidos de la API:', response.data);
                    if (Array.isArray(response.data) && response.data.length > 0) {
                        this.tasks = response.data;
                    } else {
                        console.warn('La respuesta de la API no contiene datos válidos.');
                    }
                })
                .catch(error => {
                    console.error('Error al obtener las tareas:', error);
                });
        },
        handleFilter(filterType) {
            this.filterType = filterType;
        },
        searchTasks() {
            if (this.searchQuery.trim() !== '') {
                axios.get('http://127.0.0.1:8000/api/tasks/search', {
                    params: {
                        query: this.searchQuery
                    }
                })
                .then(response => {
                    console.log('Resultados de búsqueda:', response.data);
                    this.tasks = response.data;
                })
                .catch(error => {
                    console.error('Error al buscar tareas:', error);
                });
            } else {
                this.fetchTasks();
            }
        }
    }

};
</script>

<style scoped>
.card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    margin: 16px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.task-group {
    margin: 10px;
}

.search-box {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.task-item-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.task-item-container > * {
    flex: 1 1 calc(50% - 10px);
    /* Cambia esto según el diseño deseado */
}

.task-item-container > .task-item {
    flex-basis: 100%;
}

.task-item {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.task-item h3 {
    margin-top: 0;
}

.task-item p {
    margin-bottom: 0;
}

.search-card {
    padding: 12px;
}
</style>
