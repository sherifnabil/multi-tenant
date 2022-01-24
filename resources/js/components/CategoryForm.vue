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
                    _token
                },
                errMsg: ''
            }
        },
        mounted() {

        },
        methods: {
            submit() {
                axios
                .post('/api/categories/store', this.fData, {
                    headers: {
                        Authorization: userToken
                    }
                })
                .then(({data}) => {
                    this.fData.name = '';
                    Swal.fire('Success!','Saved Successfully!','success')
                    window.events.$emit('newcategory', data)
                    this.$router.push('/categories')
                })
                .catch(err => {
                    if(err.response.data.message) {
                        this.errMsg = err.response.data.message;
                    }
                })
            },
        }
    }
</script>
