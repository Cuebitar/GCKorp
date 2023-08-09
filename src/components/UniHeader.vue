<template>
    <div class="container">
        <Menubar :model="navigators" class="menubar">
            <template #start>
                <img src="../assets/UniCoopLogo.png" style="height: 64px;" alt="logo">
            </template>

        </Menubar>
    </div>
    
</template>
<script lang="ts">
import { PrimeIcons } from 'primevue/api'
export default {
    data() {
        return {
            navigators:[
                {
                    label: 'Account',
                    items: [
                        {
                            label: 'Deposit'
                        },
                        {
                            label: 'Withdrawal'
                        }
                    ],
                    visible: !this.isGuest && this.isAuthorised
                },
                {
                    label: 'Favourite',
                    visible: !this.isGuest && this.isAuthorised
                },
                {
                    label: 'Statement',
                    visible: !this.isGuest && this.isAuthorised
                },
                {
                    label: 'Profile',
                    visible: this.isAuthorised,
                },
                {
                    icon: PrimeIcons.BELL,
                    visible: this.isAuthorised,
                },
                {
                    label: 'Logout',
                    icon: PrimeIcons.LOCK_OPEN,
                    visible: this.isAuthorised
                }
            ]
        }
    },
    props: {
        isAuthorised: Boolean,
        isGuest: Boolean,
    }
}
</script>
<style lang="scss">
@import 'primeflex/primeflex.scss';
     .p-menubar-root-list {
        @include styleclass('w-full justify-content-end')
    }
</style>
