<template>
    <div class="col-sm-9">


            <input type="number" style="width: 100px; height:40px;  display: inline-block;"
                   id="fname" @keyup="TotalBelanja"
                   placeholder="Quantity">

    </div>

</template>

<script>

    export default {
        props: ['customer_address'],
        data() {
            return {
                // this.products = produk parfum dari table product::all()
                // this.select_products untuk default text nya
                // this.products dari hasil yg diisi
                customerAddress: this.customer_address
            }
        },


        methods: {


            TotalBelanja: function () {
               console.log(this.customerAddress);
            }



        }
    }


</script>
