<template>
    <div id="profile-form">
            <form method="POST" class="needs-validation" v-on:submit.prevent novalidate>

                <!--<div class="form-row">-->
                    <!--<label for="customFile">Profile Image</label>-->
                    <!--<div class="custom-file">-->
                        <!--<input type="file" class="custom-file-input" id="customFile">-->
                        <!--<label class="custom-file-label" for="customFile">Choose file</label>-->
                    <!--</div>-->
                <!--</div>-->

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" v-on:change="image" aria-describedby="inputGroupFileAddon01" >
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">First name</label>
                        <input type="text" class="form-control" id="validationCustom01" placeholder="First name" v-model="first_name"  value="Mark" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Last name</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" v-model="last_name" value="Otto" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">Headline</label>
                        <input type="text" class="form-control" id="validationCustom03" placeholder="Headline" v-model="headline" value="Software Developer" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-7">
                        <input type="text" class="form-control" placeholder="City" v-model="city">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="State" v-model="state">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Zip" v-model="zipcode">
                    </div>
                </div>

                 <div class="form-row"><!-- limit char -->
                         <label for="exampleFormControlTextarea1">Bio</label>
                         <textarea class="form-control" maxlength="150" id="exampleFormControlTextarea1" v-model="bio" rows="3"></textarea>
                 </div>

                <div class="form-row">
                    <button class="btn btn-primary" @click="updateProfile()">Save</button>
                </div>
        </form>
    </div>
</template>

<script> // v bind form elements - accept image upload
    import axios from 'axios'
    import 'bootstrap/dist/css/bootstrap.css'
    import 'bootstrap-vue/dist/bootstrap-vue.css'
    export default {
        name: "edit-profile",
        data(){
            return {
                image: null,
                first_name: '',
                last_name: '',
                headline: '',
                city: '',
                state: '',
                zipcode: null,
                bio: ''
            }
        },
        methods: {
            updateProfile() {


                axios.post('/api/profile', {
                    image: this.image,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    headline: this.headline,
                    city: this.city,
                    state: this.state,
                    zipcode: this.zipcode,
                    bio: this.bio
                }).then(response => {
                    // this.root.$emit('updated-profile', false);
                });
            }
        }
    }
</script>

<style scoped>

</style>