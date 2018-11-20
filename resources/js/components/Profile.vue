<template> <!-- Can I have the button in this template and the modal in another? -->
    <div class="fusion-wrapper">
    <div id="profile-header">
            <img id="avatar" v-bind:src="getProfileImage()">
            <h1 id="name">{{ first_name }} {{ last_name }}</h1>
            <h2 id="headline">{{ headline }}</h2>
            <h3><img style="width: 1em; height: 1em;" src="/svg/maps-and-flags.svg"> {{ city }}, {{ state }}</h3>
            <h4>{{ bio }}</h4>
            <div class="social">
                <!-- dynamically display images for the urls that we have for the user -->
            </div>
            <!--<h6 style="color: #37718E;">Skills</h6>-->
            <!--<p> Programming </p>-->

            <!-- Button trigger modal -->
            <button type="button" id="edit-btn" class="btn" data-toggle="modal" data-target="#exampleModal">
                Edit Profile
            </button>
    </div>
    <div id="profile-body">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="edit-profile-form" class="needs-validation" novalidate>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="profileImg" @change="imageUpload()" ref="profileImage" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" >
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">First name</label>
                                        <input type="text" name="firstName" class="form-control" id="validationCustom01" placeholder="First name" v-model="first_name"  value="Mark" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Last name</label>
                                        <input type="text" name="lastName" class="form-control" id="validationCustom02" placeholder="Last name" v-model="last_name" value="Otto" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom03">Headline</label>
                                        <input type="text" name="headline" class="form-control" id="validationCustom03" placeholder="Headline" v-model="headline" value="Software Developer" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-7">
                                        <input type="text" name="city" class="form-control" placeholder="City" v-model="city">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="state" class="form-control" placeholder="State" v-model="state">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="zipcode" class="form-control" placeholder="Zip" v-model="zip_code">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="exampleFormControlTextarea1">Bio</label>
                                    <textarea class="form-control" name="bio" maxlength="150" id="exampleFormControlTextarea1" v-model="bio" rows="3"></textarea>
                                </div>

                                <div class="form-row">
                                    <button class="btn btn-primary" type="submit" data-dismiss="modal" @click="updateProfile()">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tabs-wrapper">
                <ul class="nav">
                    <li id="tab-items"
                        v-for="tab in tabs"
                        v-bind:key="tab"
                        v-bind:class="['tab-button', { active: currentTab === tab }]"
                        v-on:click="currentTab = tab">
                        <span>{{ tab }}</span></li>
                </ul>
                <keep-alive>
                    <component v-bind:is="currentTabComponent"></component>
                </keep-alive>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import 'bootstrap/dist/css/bootstrap.css'
    import 'bootstrap-vue/dist/bootstrap-vue.css'

    export default {
        name: "Profile",
        data(){
            return {
                tabs:['Projects', 'Skills'],
                currentTab: 'Projects',
                modalShow: false,
                image_path: '',
                file: null,
                first_name: '',
                last_name: '',
                headline: '',
                city: '',
                state: '',
                zip_code: '',
                bio: ''
            }
        },
        created() {
            axios.get('/api/profile').then(response => {
                this.image_path += response.data.image_path;
                this.first_name = response.data.first_name;
                this.last_name = response.data.last_name;
                this.headline = response.data.headline;
                this.city = response.data.city;
                this.state = response.data.state;
                this.bio = response.data.bio;
            });
        },
        methods: {
            updateProfile() {
                let formData = new FormData();

                formData.append('firstName', this.first_name);
                formData.append('lastName', this.last_name);
                formData.append('headline', this.headline);
                formData.append('city', this.city);
                formData.append('state', this.state);
                formData.append('zipcode', this.zip_code);
                formData.append('bio', this.bio);
                formData.append('avatar', this.file);

                axios.post('/api/profile', formData).then(response => {
                    this.image_path = response.data;
                });
            },
            imageUpload() {
                this.file = this.$refs.profileImage.files[0];
            },
            getProfileImage() {
                let profileImg = '/storage/' + this.image_path;

                return profileImg;
            }
        },
        computed: {
            currentTabComponent: function () {
                return 'tab-' + this.currentTab.toLowerCase()
            }
        }
    }
</script>

<style scoped>

</style>