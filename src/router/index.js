import { createRouter, createWebHashHistory } from 'vue-router'

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      props: {isAdmin: false},
      component: () => import('../views/homeView.vue'),
    },
    {
      path: '/logout',
      name: 'logout',
      component: () => import('../views/logoutView.vue'),
    },
    {
      path: '/dashboard',
      name: 'User Dashboard',
      props: {isAdmin: false},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/userDashboardView.vue'),
    },
    {
      path: '/profile/:id',
      name: 'profile',
      props: {isAdmin: false},
      props: true,
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/profileView.vue'),
    },
    {
      path: '/registerPersonal',
      name: 'registerPersonal',
      props: {isAdmin: false},
      component: () => import('../views/registerPersonalView.vue'),
    },  
    {
      path: '/registerBank',
      name: 'registerBank',
      props: {isAdmin: false}, 
      component: () => import('../views/registerBankView.vue'),
    },
    {
      path: '/favourite/:id',
      name: 'Favourite Account',
      props: {isAdmin: false},
      props: true,
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/favouriteView.vue'),
    },
    {
      path: '/favouriteadd',
      name: 'Add Favourite Account',
      props: {isAdmin: false},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/favouriteAddView.vue'),
    },
    {
      path: '/statement',
      name: 'Search Statement',
      props: {isAdmin: false},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/searchStatementView.vue'),
    },
    {
      path: '/transaction/:id',
      name: 'Transaction',
      props: {isAdmin: false},
      props: true,
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/transactionView.vue'),
    },
    {
      path: '/registerBank',
      name: 'registerBank',
      props: {isAdmin: false},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/registerBankView.vue'),
    },
    {
      path: '/deposit/:id',
      name: 'Deposit',
      props: true,
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/depositView.vue'),
    },
    {
      path: '/withdrawal/:id',
      name: 'Withdrawal',
      props: {isAdmin: false},
      props: true,
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/withdrawalView.vue'),
    },
    {
      path: '/notification',
      name: 'Notification',
      props: {isAdmin: false},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/notificationView.vue'),
    },
    {
      path: '/registerBank',
      name: 'registerBank',
      props: {isAdmin: false},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/registerBankView.vue'),
    },
    {
      path: '/deposit',
      name: 'Deposit',
      props: {isAdmin: false},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/depositView.vue'),
    },
    {
      path: '/withdrawal',
      name: 'Withdrawal',
      props: {isAdmin: false},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/withdrawalView.vue'),
    },
    {
      path: '/notification',
      name: 'Notification',
      props: {isAdmin: false},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/notificationView.vue'),
    },

    {
      path: 'admin/registerPersonal',
      name: 'admin registerPersonal',
      props: {isAdmin: true},
      component: () => import('../views/registerPersonalView.vue'),
    },  
    {
      path: '/admin/dashboard',
      name: 'Admin Dashboard',
      props: {isAdmin: true},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/adminDashboardView.vue'),
    },
    {
      path: '/admin/member',
      name: 'Member',
      props: {isAdmin: true},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/adminMember.vue'),
    },

    {
      path: '/admin/memberdetail/:id',
      name: 'Member Detail',
      props: true,
      props: {isAdmin: true},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/adminMemberDetail.vue'),
    },
    {
      path: '/admin/Notification',
      name: 'admin Notification',
      props: {isAdmin: true},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/adminNotificationView.vue'),
    },
    {
      path: '/admin/Transaction',
      name: 'admin Transaction',
      props: {isAdmin: true},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/adminTransactionView.vue'),
    },
    {
      path: '/admin/transactionDetails/:id',
      name: 'Admin Transaction Details',
      props: {isAdmin: true},
      props: true,
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/transactionView.vue'),
    },
    {
      path: '/admin/WithdrawalList',
      name: 'admin Withdrawal List',
      props: {isAdmin: true},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/adminWithdrawalListView.vue'),
    },

    
    {
      path: '/admin/WithdrawalDetails/:id',
      name: 'admin Withdrawal Detail',
      props: {isAdmin: true},
      props: true,
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/adminWithdrawalDetailView.vue'),
    },
    {
      path: '/admin/statement',
      name: 'admin Statement',
      props: {isAdmin: true},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/adminStatementView.vue'),
    },
    {
      path: '/admin/favourite/:id',
      name: 'Admin Favourite Account',
      props: {isAdmin: true},
      props: true,
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/favouriteView.vue'),
    },
    {
      path: '/admin/rejectReason',
      name: 'admin reject reason',
      props: {isAdmin: true},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/denyReasonView.vue'),
    },
    {
      path: '/admin/profile/:id',
      name: 'admin profile',
      props: true,
      props: {isAdmin: true},
      meta: {
        requiresAuth: true // Add meta field to indicate protected route
      },
      component: () => import('../views/profileView.vue'),
    },
    {
      path: '/example',
      name: 'example',
      component: () => import('../views/exampleView.vue'),
    },
  ]
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    const token = $cookies.get('token');
    if (token) {
      // User is authenticated, proceed to the route
      next();
    } else {
      // User is not authenticated, redirect to login
      next('/registerPersonal');
    }
  } else {
    // Non-protected route, allow access
    next();
  }
});

export default router

