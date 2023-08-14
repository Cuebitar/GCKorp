import { createRouter, createWebHashHistory } from 'vue-router'

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/devExample',
      name: 'example',
      component: () => import('../views/exampleView.vue'),
    },

    {
      path: '/profile',
      name: 'profile',
      component: () => import('../views/profileView.vue'),
    },

    {
      path: '/logout',
      name: 'logout',
      component: () => import('../views/logoutView.vue'),
    },

    {
      path: '/registerPersonal',
      name: 'registerPersonal',
      component: () => import('../views/registerPersonalView.vue'),
    },  
    
    {
      path: '/registerBank',
      name: 'registerBank',
      component: () => import('../views/registerBankView.vue'),
    },

    {
      path: '/',
      name: 'home',
      component: () => import('../views/homeView.vue'),
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
      path: '/favourite',
      name: 'Favourite Account',
      component: () => import('../views/favourite.vue'),
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
