<template>
    <div>
        <ul class="list-group">
            <li class="list-group-item" v-for="task in project.tasks" v-text="task.body"></li>
        </ul>

        <form class="mt-1">
            <div class="form-group">
                <input type="text" class="form-control" v-model="newTask" @blur="save" placeholder="Write a text...">
                <!--<small class="form-text text-muted">We'll never share your email with anyone else.</small>-->
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: [
            'dataProject'
        ],

        data() {
            return {
                project: this.dataProject,
                newTask: ''
            };
        },

        created() {
            window.Echo.channel( 'tasks.' + this.project.id ).listen( 'TaskCreatedEvent', ( { task } ) => {
                this.addTask( task );
            } );
        },

        methods: {
            save() {
                axios.post( '/api/projects/' + this.project.id + '/tasks', { body: this.newTask } )
                    .then( response => response.data )
                    .then( this.addTask );
            },

            addTask( task ) {
                this.project.tasks.push( task );

                this.newTask = '';
            }
        }
    };
</script>
