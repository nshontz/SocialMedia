<template><!-- Not sure how I'm going to store data about the languges/frameworks -->
    <div style="display: flex;">
    <section>

        <div>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="project in projects">
                    <div>
                    <h5>{{ project.name }}</h5>
                    <h6>By: {{ project.user_name }} </h6>
                    <p> {{ project.description }} </p>
                    </div>
                    <div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" @click="getProject(project.project_key)" data-toggle="modal" data-target="#exampleModal">
                            View
                        </button>
                    </div>
                </li>
            </ul>
        </div>

    <project-detail v-bind:activeProject="activeProject"></project-detail>
    </section>
    <aside>
        <form class="form-group">
            <input type="text" name="project-search"  style="width: 100%;" placeholder="Search by name, language, framework or location ">
        </form>
        <div class="mb-4" style="text-align: center;">
            <h2><span class="badge badge-light badge-pill">Skill</span>
                <span class="badge badge-info badge-pill">Project Type</span>
                <span class="badge badge-dark badge-pill">Development Stage</span>
            </h2>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#projectModal">
            Add Project
        </button>

            <!-- Modal -->
            <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Post a Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="create-project-form" class="needs-validation" novalidate>



                                <div class="form-row">
                                    <div class="mb-3 w-100">
                                        <input type="text" name="projectName" class="form-control" id="validationCustom01" placeholder="Project Name" v-model="project_name" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputSkill">Skill Requirement</label>
                                        <select id="inputSkill" class="form-control" v-model="skill">
                                            <option selected>Choose...</option>
                                            <option value="Beginner">Beginner</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Advanced">Advanced</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputType">Project Type</label>
                                        <select id="inputType" class="form-control" v-model="type">
                                            <option value="Choose..." selected>Choose...</option>
                                            <option>Tool</option>
                                            <option>Plugin</option>
                                            <option>Web app</option>
                                            <option>Desktop app</option>
                                            <option>Mobile app</option>
                                            <option>Game</option>
                                            <option>Pet project</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputStage">Development Stage</label>
                                        <select id="inputStage" class="form-control" v-model="stage">
                                            <option selected>Choose...</option>
                                            <option>Idea</option>
                                            <option>Prototype</option>
                                            <option>Beta</option>
                                            <option>Product</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4" v-if="type === 'Mobile app'">
                                        <label for="inputTech">Technologies</label>
                                        <select id="inputTech" class="form-control" >
                                            <option selected>Choose...</option>
                                            <option>Swift</option>
                                            <option>Object-C</option>
                                            <option>Coltin</option>
                                            <option>Java</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-row">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Link to Repository" v-model="repository" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">URL</span>
                                    </div>
                                </div>

                                </div>
                                <div class="form-row mb-3">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" name="description" maxlength="150" id="exampleFormControlTextarea1" v-model="description" rows="3"></textarea>
                                </div>

                                <div class="form-row">
                                    <button class="btn btn-primary" type="submit" data-dismiss="modal" @click="createProject()">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</template>

<script>
    import axios from 'axios'
    import projectDetail from './project-detail.vue'

    export default {
        name: "Project",
        data() {
            return {
                projects: null,
                project_name: '',
                skill: 'Choose...',
                type: 'Choose...',
                stage: 'Choose...',
                repository: '',
                description: '',
                activeProject: null
            }
        },
        created() {
          //   let self = this;
          // axios.get('/api/project').then(function (response) {
          //    self.projects = response.data;
          // });

            let self = this;
            axios.get('/api/project').then(function (response) {
                self.projects = response.data;
            });
        },
        methods: {
            createProject() {
                axios.post('/api/project', this.$data).then(response => {
                    console.log('data posted');
                });
            },
            getProject(key) {
                this.activeProject = this.projects.filter(project => project.project_key === key);
            }
        },
        components: {projectDetail}
    }
</script>

<style scoped>
    section {
        width: 80%;
        display: block;
        padding: 2em;
        background-color:  #f8fafc;
    }

    aside {
        width: 40%;
        padding: 2em;
    }

    button {
        display: block;
        margin: auto;
    }
</style>