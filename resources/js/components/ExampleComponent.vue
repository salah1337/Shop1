<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        data(){
            return{
                data:'',
                token:''
            }
        },
        async created() {
            await axios.get('/products').then(res=>this.token = res.data)
            await axios.post('/product/category/add',{headers: {"X-CSRFToken": this.token},}).then(res=>console.log(res))
        }
    }
</script>
