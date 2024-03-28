<template>
  <Navbar />
  <main>
    <div class="home-view">
      <div class="actions-wrapper">
        <ActionsComponent @filter="handleFilter" />
      </div>
      <div class="task-group-wrapper">
        <TaskGroup :tasks="filteredTasks" />
      </div>
    </div>
  </main>
</template>

<script>
import TaskGroup from '../components/TaskGroup.vue';
import ActionsComponent from '../components/ActionsComponent.vue';
import Navbar from '../components/NavbarComponent.vue';
import axios from 'axios';

export default {
  components: {
    TaskGroup,
    ActionsComponent,
    Navbar
  },
  data() {
    return {
      tasks: [],
      filteredTasks: [] 
    };
  },
  methods: {
    handleFilter(filterType) {
      this.filteredTasks = this.tasks.filter(task => task.status === filterType);
    },
    fetchTasks() {
      axios.get('http://127.0.0.1:8000/api/tasks')
          .then(response => {
              console.log('Datos recibidos de la API:', response.data);
              if (Array.isArray(response.data) && response.data.length > 0) {
                  this.tasks = response.data;
                  this.filteredTasks = response.data;
              } else {
                  console.warn('La respuesta de la API no contiene datos válidos.');
              }
          })
          .catch(error => {
              console.error('Error al obtener las tareas:', error);
          });
    }
  },
  mounted() {
    this.fetchTasks();
  }
};
</script>

<style scoped>
.home-view {
  display: flex;
  width: 100%;
}

.task-group-wrapper {
  flex: 0 0 70%; /* Ocupa el 70% del ancho y no se expande ni se encoge */
}

.actions-wrapper {
  flex: 0 0 30%; /* Ocupa el 30% del ancho y no se expande ni se encoge */
}
</style>
