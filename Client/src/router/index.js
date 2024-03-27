import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/newtask',
      name: 'newtask',
      component: () => import('../views/TaskView.vue')
    },
    {
      path: '/edittask/:id',
      name: 'edittask',
      component: () => import('../views/TaskView.vue')
    }
  ]
})

export default router
