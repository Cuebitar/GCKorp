<template>
  <UniHeader :isAdmin="isAdmin"></UniHeader>
  <div class="content">
    <div>
      <Panel header="Company Invest Account">
        <template #icons v-if="!guest">
          <button class="p-panel-header-icon p-link mr-2" @click="toggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512"><path d="M136 216c-22.002 0-40 17.998-40 40s17.998 40 40 40 40-17.998 40-40-17.998-40-40-40zm240 0c-22.002 0-40 17.998-40 40s17.998 40 40 40 40-17.998 40-40-17.998-40-40-40zm-120 0c-22.002 0-40 17.998-40 40s17.998 40 40 40 40-17.998 40-40-17.998-40-40-40z" fill="currentColor"/></svg>
          </button>
          <Menu ref="menu" id="config_menu" :model="items" :popup="showMenu" class="customDropdownMenu"></Menu>
        </template>
        
          <div class="w-full flex align-items-center">
            <p class="w-6">{{ tradingAccount.accountNo }}</p>
            <Divider layout="vertical"/>
            <div class="centered-container">
              <div class="profit-loss-boxes">
                  <div class="loss-box">
                      Loss: MYR {{ lossAmount.toFixed(2) }}
                  </div>
                  <Divider layout="vertical"/>
                  <div class="profit-box">
                      Profit: MYR {{ profitAmount.toFixed(2) }}
                  </div>
              </div>
            </div> 
          </div>
        
        <template #footer v-if="admin">
          <p>MYR {{ tradingAccount.balance.toFixed(2) }}</p>
        </template>
        <template #footer v-else>
          <div class="w-full flex align-items-center">
            <p class="w-6">Balance: MYR {{ tradingAccount.balance.toFixed(2) }}</p>
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
                <span class="col-3 text-right">RM {{ slotProps.data.transaction.amount.toFixed(2) }}</span>
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
      lossAmount: 1000,
      profitAmount: 5000,
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
        accountNo: '4444 5555 6666 7777',
        balance: 200000,
        initialBalance: 1000
      }, //from database
      updates: [
        {
          date: '2/7/2023',
          transaction: {
            refId: 22233,
            amount: 50000,
            status: 'Approve',
            type: 'Deposit'
          },
        },
        {
          date: '1/8/2023',
          transaction: {
            refId: 22233,
            amount: 1000,
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
.customDropdownMenu {
    position: absolute;
    right: 55px;
}

.profit-loss-boxes {
    padding: 5px 10px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* subtle shadow for the boxes */
    transition: box-shadow 0.3s ease; /* smooth transition for the hover effect */
}

.profit-loss-boxes:hover {
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* deeper shadow on hover */
}

.loss-box {
    background-color: rgba(255, 0, 0, 0.1);
    color: red;
    padding: 5px 15px; /* increased padding for better spacing */
    margin-right: 20px;
    border-radius: 4px; /* rounded corners */
    transition: background-color 0.3s ease; /* smooth transition for the hover effect */
}

.loss-box:hover {
    background-color: rgba(255, 0, 0, 0.2); /* slightly deeper color on hover */
}

.profit-box {
    background-color: rgba(0, 128, 0, 0.1);
    color: green;
    padding: 5px 15px; /* increased padding for better spacing */
    margin-left: 20px;
    border-radius: 4px; /* rounded corners */
    transition: background-color 0.3s ease; /* smooth transition for the hover effect */
}

.profit-box:hover {
    background-color: rgba(0, 128, 0, 0.2); /* slightly deeper color on hover */
}

.centered-container {
    display: flex;
    justify-content: center;
    width: 100%;
}

</style>