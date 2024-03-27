<template>
    <div>
      <NewTask v-if="isRoute('newtask')"/>
      <EditTask v-if="isRoute('edittask')" :task="taskToEdit"/>
    </div>
  </template>
  
  <script>
  import NewTask from '../components/NewTaskComponent.vue';
  import EditTask from '../components/EditTaskComponent.vue';
  import { useRoute } from 'vue-router';
  
  export default {
    components: {
      NewTask,
      EditTask
    },
    setup() {
      const route = useRoute();
  
      const isRoute = (routeName) => {
        return route.name === routeName;
      };
  
      return {
        isRoute
      };
    }
  };
  </script>
  