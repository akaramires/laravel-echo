<template>
    <div>
        <h3 v-text="project.title"></h3>

        <ul class="list-group">
            <li class="list-group-item" v-for="task in project.tasks" v-text="task.body"></li>
        </ul>

        <form class="mt-1">
            <div class="form-group">
                <input type="text" class="form-control" v-model="newTask" @blur="save" @keydown="tagPeers"
                       placeholder="Write a text...">
                <small class="form-text text-muted" v-if="activePeer"
                       v-text="activePeer.name + ' is typing...'"></small>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: [
            'data-project'
        ],

        data() {
            return {
                project    : this.dataProject,
                newTask    : '',
                activePeer : false,
                typingTimer: false
            };
        },

        computed: {
            channel() {
                return window.Echo.private( 'tasks.' + this.project.id );
            }
        },

        created() {
            this.channel
                .listen(
                    'TaskCreatedEvent',
                    ( { task } ) => this.addTask( task )
                )
                .listenForWhisper( 'typing', this.flashActivePeer );
        },

        methods: {
            flashActivePeer( e ) {
                this.activePeer = e;

                if( this.typingTimer ) clearTimeout( this.typingTimer );

                this.typingTimer = setTimeout(
                    () => this.activePeer = false,
                    3000
                );
            },

            tagPeers() {
                this.channel
                    .whisper( 'typing', { name: window.App.user.name } );
            },

            save() {
                axios.post( '/api/projects/' + this.project.id + '/tasks', { body: this.newTask } )
                    .then( response => response.data )
                    .then( this.addTask );
            },

            addTask( task ) {
                this.activePeer = false;

                this.project.tasks.push( task );

                this.newTask = '';
            }
        }
    };
</script>
