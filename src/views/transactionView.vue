<script>
export default {
    props: {
    isAdmin: Boolean,
  },
   data() {
    return {
        value: 0,
        guest: true,
        authorized: true,
        transactions:[
            {
                date: '10/1/2023',
                type: 'Deposit',
                amount: 5000,
                status: 'Pending',
                referenceId: 'RD21040'
            },
            {
                date: '10/1/2023',
                type: 'Withdrawal',
                amount: 5000,
                status: 'Pending',
                referenceId: 'RD21040'
            },
            {
                date: '10/1/2023',
                type: 'Deposit',
                amount: 5000,
                status: 'Pending',
                referenceId: 'RD21040'
            },
            {
                date: '10/1/2023',
                type: 'Withdrawal',
                amount: 5000,
                status: 'Pending',
                referenceId: 'RD21040'
            },
            {
                date: '10/1/2023',
                type: 'Deposit',
                amount: 5000,
                status: 'Pending',
                referenceId: 'RD21040'
            },
            {
                date: '10/1/2023',
                type: 'Deposit',
                amount: 5000,
                status: 'Pending',
                referenceId: 'RD21040'
            },
            {
                date: '10/1/2023',
                type: 'Withdrawal',
                amount: 5000,
                status: 'Pending',
                referenceId: 'RD21040'
            },
            {
                date: '10/1/2023',
                type: 'Deposit',
                amount: 5000,
                status: 'Pending',
                referenceId: 'RD21040'
            },
            {
                date: '10/1/2023',
                type: 'Dividen',
                amount: 300,
                status: 'Completed',
            },
        ],  //from database
        tradingAccount: {
            accountNo: '0000 1111 2222 3333',
            balance: 1000,
            initialBalance: 1000,
            status: 'Active',
            createdAt: '10/1/2023',
        }, //from database
    }
   }, 
}
</script>

<template>
    <UniHeader :isAdmin="isAdmin"></UniHeader>
    <div class="content">

        <!--Transaction Account Details-->
        <div class="mb-6"> 
            <h1 class="font-bold">Details</h1>
            <Card class="mt-4">
                <template #content>
                    <div class="col-12 grid px-4">
                        <span class="col-6 font-bold">
                            <h3 class="font-bold">Account No.</h3>
                            <span>{{ tradingAccount.accountNo }}</span>
                        </span>
                        <span class="col-6">
                            <h3 class="font-bold">Status</h3>
                            <span>{{ tradingAccount.status }}</span>
                        </span>
                        <span class="col-4">
                            <h3 class="font-bold">Initial Balance</h3>
                            <span>RM {{ tradingAccount.initialBalance }}</span>
                        </span>
                        <span class="col-4">
                            <h3 class="font-bold">Balance</h3>
                            <span>RM {{ tradingAccount.balance }}</span>
                        </span>
                        <span class="col-4">
                            <h3 class="font-bold">Created At</h3>
                            <span>{{ tradingAccount.createdAt }}</span>
                        </span>
                    </div>
                </template>
            </Card>
        </div>

        <!--Transaction Details-->
        <div>
            <h1 class="font-bold">Transaction</h1>
            <DataView :value="transactions" paginator :rows="7" class="shadow-5 mt-4 ">
                <template #list="slotProps">
                    <div class="col-12 grid mt-2 pb-2 dataViewCustom">
                        <span class="col-1">{{ slotProps.data.date }}</span>
                        <span class="col-3 text-right">{{ slotProps.data.type }}</span>
                        <span v-if="slotProps.data.referenceId != null" class="col-2 text-right">ref {{ slotProps.data.referenceId }}</span>
                        <span v-else class="col-2"></span>
                        <span class="col-3">* {{ slotProps.data.status }}</span>
                        <span class="col-3 text-right" :class="slotProps.data.type.toLowerCase() == 'deposit' || slotProps.data.type.toLowerCase() == 'dividen'? 'green':'red'">MYR {{ slotProps.data.amount.toFixed(2) }}</span>
                </div>
                </template>
            </DataView>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.red{
    color:red;
}
.green{
    color: green;
}
.dataViewCustom{
    margin-left: inherit;
}
</style>