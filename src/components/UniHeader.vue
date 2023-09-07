<template>
    <div class="container">
        <Menubar :model="isAdmin?adminNavigators:userNavigators" class="menubar">
            <template #start>
                <img src="../assets/UniCoopLogo.png" class="mainImg" style="height: 64px;" alt="logo" @click="this.$router.push({path: '/'})">
            </template>
        </Menubar>
    </div>
    
</template>
<script>
import { PrimeIcons } from 'primevue/api'
export default {
    data() {
        return {
            userId: 0,
            adminNavigators:[],
            userNavigators:[]
        }
    },
    props: {
        isAdmin: Boolean, //check if the user is an admin or not
    },
    created() {
        // Initialize data properties based on computed properties
        this.isGuest = this.$cookies.isKey('isGuest') ? this.$cookies.get('isGuest') : true;
        this.isAuthorised = this.$cookies.isKey('isAuthorised') ? this.$cookies.get('isAuthorised') : false;
        this.userId = this.$cookies.isKey('user_id') ? this.$cookies.get('userId') : 0;
        
        this.adminNavigators = [
                {
                    label: 'Account',
                    items: [
                        {
                            label: 'Deposit',
                            command: () => {this.$router.push('');}
                        },
                        {
                            label: 'Withdrawal',
                            command: () => {this.$router.push({path: '/admin/withdrawalList'});}
                        },
                        {
                            label: 'Dividen',
                            command: () => {this.$router.push('');}
                        },
                        {
                            label: 'Limit',
                            command: () => {this.$router.push('');}
                        },
                    ],
                },
                {
                    label: 'Member',
                    command: () => {this.$router.push('/admin/member');}
                },
                {
                    label: 'Favourite',
                    command: () => {this.$router.push('/admin/favourite/' + this.userId);}
                },
                {
                    label: 'Reject Reason',
                    command: () => {this.$router.push('/admin/rejectReason');}
                },
                {
                    label: 'Profile',
                    command: () => {this.$router.push('/admin/profile/' + this.userId);}
                },
                {
                    icon: PrimeIcons.BELL,
                    command: () => {this.$router.push('/admin/Notification');}
                },
                {
                    label: 'Logout',
                    icon: PrimeIcons.LOCK_OPEN,
                    command: () => {this.logout()}
                }
        ];

        this.userNavigators = [
        
            {
                    label: 'Account',
                    items: [
                        {
                            label: 'Deposit',
                            command: () => {this.$router.push('deposit');}
                        },
                        {
                            label: 'Withdrawal',
                            command: () => {this.$router.push('withdrawal');}
                        }
                    ],
                    visible: !this.isGuest && this.isAuthorised
                    
                },
                {
                    label: 'Favourite',
                    visible: !this.isGuest && this.isAuthorised,
                    command: () => {this.$router.push('favourite');}
                },
                {
                    label: 'Statement',
                    visible: !this.isGuest && this.isAuthorised,
                    command: () => {this.$router.push('statement');}
                },
                {
                    label: 'Profile',
                    visible: this.isAuthorised,
                    command: () => {this.$router.push('profile');}
                },
                {
                    icon: PrimeIcons.BELL,
                    visible: this.isAuthorised,
                    command: () => {this.$router.push('notification');}
                },
                {
                    label: 'Logout',
                    icon: PrimeIcons.LOCK_OPEN,
                    visible: this.isAuthorised,
                    command: () => {this.logout()}
                }
            
        ];
    },
    methods:{
        async logout(){
            await this.$axios.get('/api/logout',{
                headers: {
                    Authorization: "Bearer " + this.$cookies.get('token')
                }
            })
            
            const keys = this.$cookies.keys();
            keys.forEach(element => {
                this.$cookies.remove(element);
            });

            this.$router.push('/logout');
        }
    }
}
</script>
<style lang="scss">
@import 'primeflex/primeflex.scss';
     .p-menubar-root-list {
        @include styleclass('w-screen justify-content-end')
    }

    @media screen and (max-width: 960px) {
        .menubar{
            .p-menubar-start{
                a{
                    position:absolute;
                    right: 8px;
                    width: 100%;
                }
                

            }
        }
        
    }

    .mainImg:hover{
        cursor: pointer;
    }
</style>
