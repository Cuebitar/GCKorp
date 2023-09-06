<template>
    {{ isAuthorised }}
    {{ isGuest }}
    <div class="container">
        <Menubar :model="isAdmin?adminNavigators:userNavigators" class="menubar">
            <template #start>
                <img src="../assets/UniCoopLogo.png" class="mainImg" style="height: 64px;" alt="logo" @click="this.$router.push({path: '/dashboard'})">
            </template>
        </Menubar>
    </div>
    
</template>
<script>
import { PrimeIcons } from 'primevue/api'
export default {
    data() {
        return {
            userId: 1,
            adminNavigators:[
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
                    command: () => {this.$router.push('logout');}
                }
            ],
            userNavigators:[
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
                    visible: !this.$isGuest && this.$isAuthorised
                    
                },
                {
                    label: 'Favourite',
                    visible: !this.$isGuest && this.$isAuthorised,
                    command: () => {this.$router.push('favourite');}
                },
                {
                    label: 'Statement',
                    visible: !this.$isGuest && this.$isAuthorised,
                    command: () => {this.$router.push('statement');}
                },
                {
                    label: 'Profile',
                    visible: this.$isAuthorised,
                    command: () => {this.$router.push('profile');}
                },
                {
                    icon: PrimeIcons.BELL,
                    visible: this.$isAuthorised,
                    command: () => {this.$router.push('notification');}
                },
                {
                    label: 'Logout',
                    icon: PrimeIcons.LOCK_OPEN,
                    visible: this.$isAuthorised,
                    command: () => {this.$router.push('logout');}
                }
            ]
        }
    },
    props: {
        isAdmin: Boolean, //check if the user is an admin or not
    },
    computed: {
        
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
