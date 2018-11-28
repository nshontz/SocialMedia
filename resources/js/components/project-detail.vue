<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div>
                            <span class="badge badge-light badge-pill">{{ data.skill }}</span>
                            <span class="badge badge-info badge-pill">{{ data.type }}</span>
                            <span class="badge badge-dark badge-pill"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "project-detail",
        props: ['activeProject'],
        data() {
            return {
                data: null
            }
        },
        mounted() {
           this.data = this.props.activeProject;
        }
    }
</script>

<style scoped>

</style>