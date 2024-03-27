<template>
      <Navbar />
  <main>
    <div class="home-view">
      <div class="actions-wrapper">
        <ActionsComponent />
      </div>
      <div class="task-group-wrapper">
        <TaskGroup />
      </div>
    </div>
  </main>
</template>

<script>
import TaskGroup from '../components/TaskGroup.vue';
import ActionsComponent from '../components/ActionsComponent.vue'
import Navbar from '../components/NavbarComponent.vue'

export default {
  components: {
    TaskGroup,
    ActionsComponent,
    Navbar
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