import { createRouter, createWebHashHistory } from 'vue-router'
import loginView from '../views/loginView.vue'

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: loginView
    },
    {
      path: '/devExample',
      name: 'example',
      component: () => import('../views/exampleView.vue'),
    },
    {
      path: '/dashboard',
      name: 'User Dashboard',
      component: () => import('../views/userDashboard.vue'),
    },
    {
      path: '/statement',
      name: 'Search Statement',
      component: () => import('../views/searchStatement.vue'),
    },
    {
      path: '/transaction',
      name: 'Transaction',
      component: () => import('../views/transaction.vue'),
    }
    //*{
    //  path: '/about',
    //  name: 'about',
    //  component: () => import("")
    //}
  ]
})

export default router
