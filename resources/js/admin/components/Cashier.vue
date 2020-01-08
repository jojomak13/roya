<template>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="product">كود المنتج</label>
                    <input autofocus type="text" v-model="search" id="product" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" @click="save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>أسم المنتج</th>
                            <th>الكمية</th>
                            <th>سعر القطعة</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product, index) in products" :key="index" :class="{'bg-warning': !product.stores[0].pivot.quantity}">
                            <td>{{ index+1 }}</td>
                            <td>{{ product.name_ar }}</td>
                            <td><input type="number" :p-id="product.id" @change="updateQuantity" :disabled="!product.stores[0].pivot.quantity" value="1" min="1" :max="product.stores[0].pivot.quantity" class="form-control"></td>
                            <td>{{ product.sell_price }}</td>
                            <td><button class="btn btn-danger" @click="deleteProduct(index)" :p-id="product.id"><i class="fa fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import axios from 'axios';
    export default {
        data(){
            return {
                search: '',
                productsNumber: 0, 
                products: [],
                cart: [],
            }
        },
        methods: {
            addToCart(product){
                this.cart.push({
                    productId: product.id,
                    price: product.sell_price,
                    totalPrice: !product.stores[0].pivot.quantity? 0 : product.sell_price, 
                    quantity: !product.stores[0].pivot.quantity? 0 : 1
                })
            },
            updateQuantity(e){
                let productId = e.target.getAttribute('p-id');
                let quantity = e.target.value;
                
                this.cart.map(el => {
                    if(el.productId == productId){
                        el.quantity = quantity
                        el.totalPrice = el.price * quantity
                    }
                    return el;
                })
            },
            deleteProduct(index){
                this.products.splice(index, 1);
                this.cart.splice(index, 1);
            },
            save(){
                axios.post('http://roya.test/ar/dashboard/orders', this.cart).then(res => {
                    this.cart = [];
                    this.products = [];
                    toast.fire({
                        icon: 'success',
                        title: "تم الطلب بنجاح"
                    })
                });
            }
        },
        watch: {
            search(data){
                axios.get(`http://roya.test/ar/dashboard/products/${data}`).then((res) => {
                    if(res.data.status){
                        let isExist = this.products.some(el => el.barcode == res.data.product.barcode);

                        if(!isExist){
                            this.products.push(res.data.product)
                            this.addToCart(res.data.product)
                        }
                    }
                    this.search = ''
                })
            }
        }
    }
</script>
