<template>
    <div class="container">
        <form @submit.prevent="submit">
            <div class="row mb-3">
                <label class="col-md-3 col-form-label text-md-end">Name</label>
                <div class="col-md-9">
                    <input @input="errMsg = ''" v-model="fData.name" type="text" class="form-control" :class="{'is-invalid': errMsg}" autofocus>
                    <span v-if="errMsg" class="invalid-feedback" role="alert">
                        <strong>{{ errMsg }}</strong>
                    </span>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-3 col-form-label text-md-end">Price</label>
                <div class="col-md-9">
                    <input @input="priceErrMsg = ''" v-model="fData.price" type="number" class="form-control" :class="{'is-invalid': priceErrMsg}" autofocus>
                    <span v-if="priceErrMsg" class="invalid-feedback" role="alert">
                        <strong>{{ priceErrMsg }}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                fData: {
                    name: '',
                    price: '',
                    category_id: this.$route.params.id,
                },
                errMsg: '',
                priceErrMsg: ''
            }
        },
        mounted() {

        },
        methods: {
            submit() {
                axios
                .post('/api/category/' + this.$route.params.id + '/products/store', this.fData)
                .then(({data}) => {
                    this.fData.name = '';
                    Swal.fire('Success!','Saved Successfully!','success')
                    // this.$emit('newproduct', data)
                    setTimeout(() => {
                        window.location.href = '/category/' + this.$route.params.id + '/products';
                    }, 2000)
                })
                .catch(err => {
                    // this.errMsg = err.response.data.message;
                    if(err.response.data.errors.name) {
                        this.errMsg = err.response.data.errors.name[0]
                    }
                    if(err.response.data.errors.price) {
                        this.priceErrMsg = err.response.data.errors.price[0]
                    }
                })
            }
        }
    }
</script>
