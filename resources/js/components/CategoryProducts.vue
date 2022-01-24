<template>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <router-link class="btn btn-warning" :to="'/categories'">Categories</router-link>
                <router-link class="btn btn-primary" :to="'/category/' + categoryId + '/products/create'">Add</router-link>
            </div><br><br><hr>
        </div>
        <div class="row" v-for="product in products" :key="product.id">
            <div class="col-md-9">
                <h3>{{ product.name }} - {{ product.price }}</h3>
            </div>
            <div class="col-md-3">
                    <button class="btn btn-danger btn-sm" @click="confirm(product.id, index)">Delete</button>
                </div>
            <hr>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                categoryId: this.$route.params.id,
            }
        },
        mounted() {
            window.events.$on('newproduct', (data) => this.products.push(data));
            this.getCategories();
        },
        methods: {
            getCategories() {
                axios
                .get('/api/category/' + this.$route.params.id + '/products/', {
                    headers: {
                        Authorization: userToken
                    }
                })
                .then(({data}) => {
                    this.products = data;
                })
                .catch(err => {
                })
            },

            deleteProduct(productId, index) {
                const self = this;

                axios
                .post('/api/products/' + productId + '/delete', {
                    _token
                })
                .then(({data}) => {
                    self.products.splice(index, 1);
                })
                .catch(err => {
                })
            },

            confirm(productId, index) {
                Swal.fire({
                    title: 'Do you want to Delete the Product?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.deleteProduct(productId, index)
                        Swal.fire('Success!','Saved Successfully!','success')
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            }
        }
    }
</script>
