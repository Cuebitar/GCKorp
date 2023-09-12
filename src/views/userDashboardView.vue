<template>
<UniHeader :isAdmin="isAdmin"></UniHeader>
  <div class="content">
    <div>
      <Panel header="Individual Invest Account">
        <template #icons v-if="!guest">
          <button class="p-panel-header-icon p-link mr-2" @click="toggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512"><path d="M136 216c-22.002 0-40 17.998-40 40s17.998 40 40 40 40-17.998 40-40-17.998-40-40-40zm240 0c-22.002 0-40 17.998-40 40s17.998 40 40 40 40-17.998 40-40-17.998-40-40-40zm-120 0c-22.002 0-40 17.998-40 40s17.998 40 40 40 40-17.998 40-40-17.998-40-40-40z" fill="currentColor"/></svg>
          </button>
          <Menu ref="menu" id="config_menu" :model="items" :popup="showMenu" class="customDropdownMenu"></Menu>
        </template>
        <div>
          {{ tradingAccount.accountNo }}
        </div>
        <template #footer v-if="guest">
          <p>MYR {{ tradingAccount.balance.toFixed(2) }}</p>
        </template>
        <template #footer v-else>
          <div class="w-full flex align-items-center">
            <p class="w-6">Balance: MYR {{ tradingAccount.balance.toFixed(2) }}</p>
            <Divider layout="vertical"/>
            <p>Dividen: MYR {{ dividen.toFixed(2) }}</p>
          </div> 
        </template>
      </Panel>
    </div>

    <div class="mt-5">
      <Panel header="Updates">
        <div>
          <DataView :value="updates" >
            <template #list="slotProps">
              <div class="col-12 grid px-2 mt-2 pb-2 ">
                <span class="col-1">{{ slotProps.data.date }}</span>
                <span class="col-3 text-right">{{ slotProps.data.transaction.type }}</span>
                <span class="col-2 text-right">ref {{ slotProps.data.transaction.refId }}</span>
                <span class="col-3">* {{ slotProps.data.transaction.status }}</span>
                <span class="col-3 text-right" :class="slotProps.data.transaction.type.toLowerCase() == 'deposit' || slotProps.data.type.toLowerCase() == 'dividen'? 'green':'red'">RM {{ slotProps.data.transaction.amount.toFixed(2) }}</span>
              </div>
            </template>
          </DataView>
        </div>
      </Panel>
    </div>
    <div style="height:100vh;"></div>
  </div>
</template>

<script>
import { ref } from 'vue';
import { defineComponent} from 'vue';

export default defineComponent({
  props: {
    isAdmin: Boolean,
  },
  data() {
    return {
      value: 0,
      guest: false,
      authorized: true,
      items: [
        {
          label: 'Deposit',
          command: () => {this.$router.push('deposit');}

        },
        {
          label: 'Withdrawal',
          command: () => {this.$router.push('withdrawal');}
        },
        {
          label: 'Statement',
          command: () => {this.$router.push('statement');}
        }
      ], 
      tradingAccount: {
        accountNo: '0000 1111 2222 3333',
        balance: 2000,
        initialBalance: 1000
      }, //from database
      updates: [
        {
          date: '1/7/2023',
          transaction: {
            refId: 22233,
            amount: 2000,
            status: 'Approve',
            type: 'Deposit'
          },
        },
        {
          date: '1/7/2023',
          transaction: {
            refId: 22233,
            amount: 2000,
            status: 'Approve',
            type: 'Deposit'
          },
        },

      ],// from database
      showMenu: true
    };
  },
  methods: {
    toggle() {
      this.showMenu = !this.showMenu;
    },
  },
  computed: {
    dividen(){
      return this.tradingAccount.balance - this.tradingAccount.initialBalance;
    }
  }
});
</script>

<style>
.customDropdownMenu{
  position: absolute;
  right: 55px;
}

.red{
  color: red;
}

.green{
  color: green;
}
</style>