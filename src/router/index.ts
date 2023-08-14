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
      path: '/favourite',
      name: 'Favourite Account',
      component: () => import('../views/favourite.vue'),
    },


    {
      path: '/favouriteadd',
      name: 'Add Favourite Account',
      component: () => import('../views/favouriteAdd.vue'),
    },

    {
      path: '/registerBank',
      name: 'registerBank',
      component: () => import('../views/registerBankView.vue'),
    },
    
    {
      path: '/deposit',
      name: 'Deposit',
      component: () => import('../views/deposit.vue'),
    },

    {
      path: '/withdrawal',
      name: 'Withdrawal',
      component: () => import('../views/withdrawal.vue'),
    },

    {
      path: '/notification',
      name: 'Notification',
      component: () => import('../views/notification.vue'),
    },

    
    //*{
    //  path: '/about',
    //  name: 'about',
    //  component: () => import("")
    //}
  ]
})

export default router
