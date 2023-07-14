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
    }
    //*{
    //  path: '/about',
    //  name: 'about',
    //  component: () => import("")
    //}
  ]
})

export default router
