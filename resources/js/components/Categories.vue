<template>
    <div class="container">
        <div v-for="(category, index) in categories" :key="category.id">
             <div class="row">
                <div class="col-md-9">
                    {{ category.name }}
                </div>
                <div class="col-md-3">
                    <router-link class="btn btn-primary btn-sm" :to="'/category/' + category.id + '/products'">Products</router-link>
                    <button class="btn btn-danger btn-sm" @click="confirm(category.id, index)">Delete</button>
                </div>
            </div>
            <hr>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: []
            }
        },
        mounted() {
            this.getCategories();
            window.events.$on('newcategory', (data) => this.categories.push(data));
        },
        methods: {
            getCategories() {
                axios
                .get('/all-categories', {
                    headers: {
                        Authorization: userToken
                    }
                })
                .then(({data}) => {
                    this.categories = data;
                })
                .catch(err => {
                })
            },

            deleteCategory(categoryId, index) {
                const self = this;

                axios
                .post('/api/categories/delete/' + categoryId, {
                    _token
                })
                .then(({data}) => {
                    self.categories.splice(index, 1);
                })
                .catch(err => {
                })
            },

            confirm(categoryId, index) {
                Swal.fire({
                    title: 'Do you want to Delete the Category?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.deleteCategory(categoryId, index)
                        Swal.fire('Success!','Saved Successfully!','success')
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            }
        }
    }
</script>
