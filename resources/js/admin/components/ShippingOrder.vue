<template>
  <div>
    <div class="row">
      <div class="col-lg-5">
        <div class="card">
          <div class="card-body text-center">
            <img class="img-fluid" :src="order.user.profile_image " />
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="card">
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item">
                <span>الأسم</span>
                : {{ order.user.first_name + ' ' + order.user.last_name }}
              </li>
              <li class="list-group-item">
                <span>المدينة</span>
                :
                {{ order.user.city }}
              </li>
              <li class="list-group-item">
                <span>العنوان</span>
                :
                {{ order.user.address }}
              </li>
            </ul>

            <div class="form-group mt-2">
              <button @click="updateOrder" class="btn btn-success">أنهاء الطلب</button>
            </div>
          </div>
        </div>
      </div>
    </div>
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
          <tbody>
            <tr v-for="(product, index) in order.products" :key="product.id">
              <td>{{ index + 1 }}</td>
              <td>{{ product | trans }}</td>
              <td>
                <ul class="product-colors">
                  <li v-for="(quantity, color) in product.serialized_data" :key="color">
                    <i class="fa fa-circle" :style="{'color': color}"></i> <strong>{{ quantity }}</strong>
                  </li>
                </ul>
              </td>
              <td>{{ product.price.toLocaleString() }} ج.م</td>
              <td>
                <span class="badge badge-success p-2">تم الأضافة</span>
              </td>
            </tr>
          </tbody>
        </table>
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
      order: {}
    };
  },
  created() {
    this.order = JSON.parse(this.data);
  },
  methods: {
    updateOrder() {
      axios.patch("/dashboard/orders/" + this.order.id).then(res => {
        toast.fire({
          icon: "success",
          title: "تم أنهاء الطلب بنجاح"
        });
      });
    }
  }
};
</script>

<style scoped>
.product-colors{
  list-style-type: none;
}
</style>