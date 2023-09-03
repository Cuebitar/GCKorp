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
      component: () => import('../views/userDashboardView.vue'),
    },

    {
      path: '/statement',
      name: 'Search Statement',
      component: () => import('../views/searchStatementView.vue'),
    },

    {
      path: '/transaction',
      name: 'Transaction',
      component: () => import('../views/transactionView.vue'),
    },

    {
      path: '/favourite',
      name: 'Favourite Account',
      component: () => import('../views/favouriteView.vue'),
    },

    {
      path: '/favouriteadd',
      name: 'Add Favourite Account',
      component: () => import('../views/favouriteAddView.vue'),
    },
    
    {
      path: '/registerBank',
      name: 'registerBank',
      component: () => import('../views/registerBankView.vue'),
    },

    {
      path: '/deposit',
      name: 'Deposit',
      component: () => import('../views/depositView.vue'),
    },

    {
      path: '/withdrawal',
      name: 'Withdrawal',
      component: () => import('../views/withdrawalView.vue'),
    },
    
    {
      path: '/notification',
      name: 'Notification',
      component: () => import('../views/notificationView.vue'),
    },

    {
      component: () => import('../views/transactionView.vue'),
    },

    {
      path: '/favourite',
      name: 'Favourite Account',
      component: () => import('../views/favouriteView.vue'),
    },

    {
      path: '/favouriteadd',
      name: 'Add Favourite Account',
      component: () => import('../views/favouriteAddView.vue'),
    },
    
    {
      path: '/registerBank',
      name: 'registerBank',
      component: () => import('../views/registerBankView.vue'),
    },

    {
      path: '/deposit',
      name: 'Deposit',
      component: () => import('../views/depositView.vue'),
    },

    {
      path: '/withdrawal',
      name: 'Withdrawal',
      component: () => import('../views/withdrawalView.vue'),
    },
    
    {
      path: '/notification',
      name: 'Notification',
      component: () => import('../views/notificationView.vue'),
    },

    {
      path: '/admin/member',
      name: 'Member',
      component: () => import('../views/adminMember.vue'),
    },

    {
      path: '/admin/memberdetail',
      name: 'Member Detail',
      component: () => import('../views/adminMemberDetail.vue'),
    },

    {
      path: '/admin/Notification',
      name: 'admin Notification',
      component: () => import('../views/adminNotificationView.vue'),
    },

    {
      path: '/admin/Transaction',
      name: 'admin Transaction',
      component: () => import('../views/adminTransactionView.vue'),
    },

    {
      path: '/admin/WithdrawalList',
      name: 'admin Withdrawal List',
      component: () => import('../views/adminWithdrawalListView.vue'),
    },

    
    {
      path: '/adminWithdrawalDetails',
      name: 'admin-Withdrawal-Detail',
      component: () => import('../views/adminWithdrawalDetailView.vue'),
    }


  ]
})

export default router

