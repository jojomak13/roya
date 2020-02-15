<template>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label for="barcode">أدخل كود المنتج</label>
            <input type="text" v-model="barcode" class="form-control" id="barcode" autofocus />
          </div>
          <button class="btn btn-success" @click="updateOrder" :disabled="!isReady">نقل الى الشحن</button>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>المنتج</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>الحالة</th>
              </tr>
            </thead>
            <tbody ref="table">
              <tr
                v-for="(product, index) in order.products"
                :key="product.id"
                :data-code="product.barcode"
              >
                <td>{{ index + 1 }}</td>
                <td>{{ product | trans }}</td>
                <td>{{ product.quantity }}</td>
                <td>{{ product.price.toLocaleString() }} ج.م</td>
                <td>
                  <span class="badge badge-danger p-2">غير مضاف</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
    
<script>
import axios from "axios";

export default {
  props: ["data"],
  data() {
    return {
      barcode: "",
      order: {},
      preparedProducts: {},
      statusType: {
        success: '<span class="badge badge-success p-2">تم الأضافة</span>',
        danger: '<span class="badge badge-danger p-2">غير مضاف</span>'
      },
      isReady: false
    };
  },
  created() {
    this.order = JSON.parse(this.data);
    this.order.products.forEach(el => {
      this.preparedProducts[el.barcode] = false;
    });
  },
  methods: {
    readyForShipping() {
      for (let product in this.preparedProducts) {
        if (!this.preparedProducts[product]) return false;
      }

      return true;
    },
    updateOrder() {
      axios.patch("/dashboard/orders/" + this.order.id).then(res => {
        toast.fire({
          icon: "success",
          title: "تم تجهيز الطلب بنجاح"
        });
      });
    }
  },
  watch: {
    barcode(barcode) {
      const validProduct = this.order.products.some(product => {
        return product.barcode == barcode;
      });

      if (validProduct && !this.preparedProducts[barcode]) {
        let productEl = this.$refs.table.querySelector(
          `tr[data-code="${barcode}"] td:last-child`
        );

        productEl.innerHTML = this.statusType.success;

        this.preparedProducts[barcode] = true;

        this.isReady = this.readyForShipping() ? true : false;

      }

      setTimeout(() => this.barcode = "", 300);
    }
  }
};
</script>