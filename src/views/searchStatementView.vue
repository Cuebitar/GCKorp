<script>
export default {
    props: {
        isAdmin: Boolean,
    },
    data() {
        return {
            search: {
                date: '',
                type: ''
            },
            account: {
               accountNumber: 222331233325,
               balance: 2000
            }, //from database
            typeOptions: [
                {
                    label: "Status", // The label of the option group
                    items: [
                        { label: "Successful", value: "successful" },
                        { label: "Failed", value: "failed" },
                        // Add more options within this option group as needed
                    ],
                },
                {
                    label: "Transaction", // The label of the second option group
                    items: [
                        { label: "Deposit", value: "deposit" },
                        { label: "Withdrawal", value: "withdrawal" },
                        // Add more options within this option group as needed
                    ],
                },
            ],
            startDate: new Date(2022, 12),
            today: new Date()
        }
    },
    props: {
        isGuest: Boolean,
        isAuthorized: Boolean,
    },
    computed: {
        account() {
            return this.account.accountNumber + '                                                                  RM' + this.account.balance;
        },
    }
}
</script>

<template>
    <UniHeader :isAdmin="isAdmin"></UniHeader>

    <!--Content-->
    <div class="content flex flex-column gap-3 w-screen" style="margin-top: 10%!important;">
        <div class="inputArea">
            <label for="account">Account</label>
            <InputText class="w-30rem" id="account" v-model="value3" type="text" :placeholder="account" disabled/>
        </div>
        <div class="inputArea">
            <label for="account">Month</label>
            <Calendar class="w-30rem" view="month" dateFormat="mm/yy" v-model="search.date" placeholder="Month" :minDate="startDate" :maxDate="today"/>
        </div>
        <div class="inputArea">
            <label for="account">Type</label>
            <Dropdown class="w-30rem" :options="typeOptions" optionLabel="label" optionGroupLabel="label" optionGroupChildren="items" v-model="search.type" placeholder="Summary" />
        </div>
        <Button class="mt-8 w-8rem align-self-center" label="Search" />
    </div>
</template>

<style lang="scss" scoped>
@import 'primeflex/primeflex.scss';
.inputArea{
    @include styleclass('gap-3 flex flex-row justify-content-end w-8');
    label{
        font-size: 20px;
    }
}

#account::placeholder{
    color: black;
}
</style>