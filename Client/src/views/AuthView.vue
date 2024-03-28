<template>
    <div>
        <LoginComponent v-if="isRoute('login')" />
        <SignUpComponent v-if="isRoute('signup')" :task="taskToEdit" />
    </div>
</template>

<script>
  import LoginComponent from '../components/LoginComponent.vue';
  import SignUpComponent from '../components/SignUpComponent.vue';
  import { useRoute } from 'vue-router';
  
  export default {
    components: {
      LoginComponent,
      SignUpComponent
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