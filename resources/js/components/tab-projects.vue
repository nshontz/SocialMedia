<template>
    <div class="tab-body">
        <div  v-if="data">
            <ul class="list-group list-group-flush ml-3" style="display: inline-block" v-for="item in data">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ item.name }}</h5>
                        <p class="card-text">{{ item.description }}</p>
                        <a v-bind:href="item.repository" class="btn btn-light btn-sm"  target="_blank">Visit Repo</a>
                    </div>
                </div>
            </ul>
        </div>
        <p v-else>No projects available.</p>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "tab-projects",
        data() {
            return {
                data: null
            }
        },
        created() {
            let self = this;
            axios.get('api/project').then(function (response) {
               self.data = response.data;
            });
        }
    }
</script>

<style scoped>

</style>