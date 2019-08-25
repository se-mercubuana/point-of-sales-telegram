<template>
    <div class="col-sm-9">
        <div v-for="(value_product, index) in value_products">
            <select class="form-control custom-select" v-model="value_product.product_id"
                    :name=" 'product_id[]' " @change="TotalBelanja"
                    style="width: 50%; height:36px; display: inline-block;">
                <option v-for="product in allProducts" :value="product.id">{{product.name}} ({{product.price_convert}})
                </option>
            </select>
            <input type="number" style="width: 100px; height:40px;  display: inline-block;"
                   v-model="value_product.quantity" :name=" 'quantity[]' "
                   :class="[
                                'form-control',
                                'quantity-text',
                                'quantity-text-number' + index
                            ]"
                   id="fname" @keyup="TotalBelanja"
                   placeholder="Quantity">
            <div class="invalid-feedback">
                {{messageError}}
            </div>


            <!--<input type="text"  class="form-control is-invalid" id="validationServer01">-->
            <!--<div class="invalid-feedback">-->
                <!--Please correct the error-->
            <!--</div>-->

            <div style="margin-top:10px;">
                <button type="button" @click="addSelectProduct" class="btn btn-success"
                        v-show="value_products.length == index+1">
                    TAMBAH
                </button>
                <button type="button" @click="removeSelectProduct" class="btn btn-danger"
                        v-show="value_products.length == index+1">
                    HAPUS
                </button>
            </div>
        </div>

        <h4 style="margin-top:20px;">
            Total: Rp. {{ formatRupiah(total) }}
        </h4>
    </div>

</template>

<script>

    console.log('masuk');

    export default {
        props: ['products'],
        data() {
            return {
                // this.products = produk parfum dari table product::all()
                // this.select_products untuk default text nya
                // this.products dari hasil yg diisi
                allProducts: this.products,
                // product_id: '',
                // quantity: 0,
                value_products: [
                    {product_id: '', quantity: 1}
                ],
                total: 0,
                totalTemporary: 0,
                // url: 'https://admin-parfumislami.test/api',
                url: 'http://127.0.0.1:8000/api',
                messageError: 'quantity atau produk Tidak Boleh Kosong'
            }
        },


        methods: {

             formatRupiah(bilangan){
                 var	number_string = bilangan.toString(),
                     sisa 	= number_string.length % 3,
                     rupiah 	= number_string.substr(0, sisa),
                     ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

                 if (ribuan) {
                     var separator = sisa ? '.' : '';
                     rupiah += separator + ribuan.join('.');
                 }
                 return rupiah;
             },

            calculateTotal(i) {
                var qty = this.value_products[i].quantity;
                if(qty || qty != 0){
                    axios.get(this.url + '/product/detail/' + this.value_products[i].product_id).then(response => {
                        var price = response.data.price;
                        var totalPerProduct = qty * price;
                        var totally = this.totalTemporary + totalPerProduct;
                        this.total = totally;
                        this.totalTemporary = totally;
                        $(".quantity-text-number" + i).removeClass("is-invalid");
                    });
                }else{
                    this.total = 0;
                    $(".quantity-text-number" + i).addClass("is-invalid");
                    // alert('quantity Tidak Boleh Kosong');
                }
            },


            addSelectProduct: function () {
                this.totalTemporary = 0;
                for(var i = 0; i < this.value_products.length; i++){
                    this.calculateTotal(i)
                }

                var arrayLength = this.value_products.length;
                if (arrayLength < 10) {
                    this.value_products.push({
                        product_id: '',
                        quantity: 1
                    });
                }
            },
            removeSelectProduct: function () {
                if (this.value_products.length > 1) {
                    this.value_products.pop();


                    this.totalTemporary = 0;
                    for(var i = 0; i < this.value_products.length; i++){
                        this.calculateTotal(i)
                    }
                }
            },

            TotalBelanja: function () {
                this.totalTemporary = 0;
                for(var i = 0; i < this.value_products.length; i++){
                    this.calculateTotal(i)
                }

                // var totalBefore = 0;
                // for(var i = 0; i < this.value_products.length; i++){
                //     var qty = this.value_products[i].quantity;
                //     if(qty){
                //         axios.get(this.url + '/product/detail/' + this.value_products[i].product_id).then(response => {
                //             var price = response.data.price;
                //             var totalPerProduct = qty * price;
                //             var totally = totalBefore + totalPerProduct;
                //         console.log(totally);
                //             this.total = totally;
                //             totalBefore = totally;
                //         });
                //     }else{
                //         this.total = 0;
                //     }
                // }
                //
                // console.log(this.total);

                // console.log(this.value_product);
                // console.log(this.value_products.length);
                // for(var i = 0; i < this.value_products.length; i++){
                //     console.log(this.value_products[i].quantity);
                //     console.log(this.value_products[i].product_id);
                // }
            }



        }
    }


</script>
