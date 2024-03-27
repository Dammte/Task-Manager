<template>
    <div>
      <NewTask v-if="mode === 'new'"/>
      <EditTask v-if="mode === 'edit'" :task="taskToEdit"/>
    </div>
  </template>
  
  <script>
  import NewTask from '../components/NewTaskComponent.vue';
  import EditTask from '../components/EditTaskComponent.vue';
  
  export default {
    components: {
      NewTask,
      EditTask
    },
    data() {
      return {
        mode: 'new', // Modo por defecto es nuevo
        taskToEdit: null // Tarea para editar
      };
    }
  };
  </script>
  
  <style scoped>
  </style>
  