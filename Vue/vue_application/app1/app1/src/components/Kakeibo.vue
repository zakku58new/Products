<template>
  <h1>{{ month }}月</h1>
  <div>
    <div class="info">
      <div class="bank_info">
        <p>口座</p>
        <span>￥</span><input type="text" v-model="bank" />
      </div>
      <div class="salary_info">
        <p>給料</p>
        <span>￥</span><input type="text" v-model="bank" />
      </div>
    </div>
    <div class="pay_info">
      <div class="credit_info">
        <p>クレカ</p>
          <span>￥</span><input type="text" v-model="bank" />
          <span>￥</span><input type="text" v-model="bank" />
        <p>三井</p>
        <span>￥</span><input type="text" v-model="bank" />
      </div>
      <div class="cost_info">
        <p>生活費</p>
        <span>￥</span><input type="text" v-model="bank" />
        <span>￥</span><input type="text" v-model="bank" />
        <span>￥</span><input type="text" v-model="bank" />
        <span>￥</span><input type="text" v-model="bank" />
        <span>￥</span><input type="text" v-model="bank" />
        <span>￥</span><input type="text" v-model="bank" />
        <p>クレカ計</p>
        <span>￥</span><input type="text" v-model="bank" />
        <span>￥</span><input type="text" v-model="bank" />
        <span>￥</span><input type="text" v-model="bank" />
        <p>合計</p>
        <span>￥</span><input type="text" v-model="bank" />
        <p>口座</p>
        <span>￥</span><input type="text" v-model="bank" />
      </div>
    </div>
    <div class="pay_month">
      <div class="credit_total">
        <p>クレカ合計</p>
        <p>金額</p>
      </div>
      <div class="credit_table">テーブル</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      month: "2",
    };
  },
};
</script>

<style scoped>
.info {
  display: flex;
  justify-content: center;
}
.bank_info {
  padding: 5px;
  border: 1px solid;
  width: 45%;
  height: 80px;
  margin-right: 10px;
}
.salary_info {
  padding: 5px;
  border: 1px solid;
  width: 45%;
  height: 80px;
}
.pay_info {
  display: flex;
  justify-content: center;
}
.credit_info {
  padding: 5px;
  border: 1px solid;
  width: 48%;
  height: 400px;
  margin: 10px;
}
.cost_info {
  padding: 5px;
  border: 1px solid;
  width: 48%;
  height: 400px;
  margin: 10px;
}
.pay_month {
  padding: 5px;
  border: 1px solid;
  width: 98%;
  height: 240px;
  margin: 10px;
}
.credit_total {
  display: flex;
  border: 1px solid;
  height: 60px;
  padding: 5px;
}
.credit_table {
  margin: 5px;
}
</style>