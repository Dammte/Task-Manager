// store.js
import { createStore } from 'vuex';

const store = createStore({
  state: {
    taskToEdit: null
  },
  mutations: {
    setTaskToEdit(state, task) {
      state.taskToEdit = task;
    }
  },
  actions: {
    setTaskToEdit(context, task) {
      context.commit('setTaskToEdit', task);
    }
  },
  modules: {
    // Puedes agregar más módulos aquí si lo necesitas
  }
});

export default store;
