<template>
    <div class="row">
        <div class="col-9">
            <h5 v-text="chat.title"></h5>

            <div class="chat border p-3 mb-3 rounded">
                <div class="chat-message" v-for="message in chat.messages">
                    <p class="chat-message-text text-left" v-text="message.body"></p>
                    <p class="chat-message-date text-muted" v-text="message.created_at"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <input type="text" class="form-control" v-model="newMessage" @keydown="tagPeers"
                           placeholder="Write a text...">
                    <small class="form-text text-muted" v-if="activePeer"
                           v-text="activePeer.name + ' is typing...'"></small>
                </div>
            </div>
        </div>

        <div class="col-3">
            <h5>Active Participants</h5>

            <ul class="list-group">
                <li class="list-group-item" v-for="participant in participants" v-text="participant.name"></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'data-chat'
        ],

        data() {
            return {
                chat     : this.dataChat,
                newMessage     : '',
                participants: [],
                chats    : [],
                activePeer  : false,
                typingTimer : false
            };
        },

        computed: {
            channel() {
                return window.Echo.join( 'messages.' + this.chat.id );
            }
        },

        created() {
            this.channel
                .here( data => {
                    if( data.length ) {
                        for( var i in data ) {
                            if( !data.hasOwnProperty( i ) ) continue;

                            this.participants.push( data[ i ].user );
                        }
                    }
                } )
                .joining( data => {
                    this.participants.push( data.user );
                } )
                .leaving( data => {
                    this.participants.splice( this.participants.indexOf( data.user ), 1 );
                } )
                .listen( 'MessageCreatedEvent', ( { message } ) => this.addMessage( message ) )
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

            tagPeers( e ) {
                if( e.keyCode == 13 ) {
                    this.save();
                }

                this.channel
                    .whisper( 'typing', { name: window.App.user.name } );
            },

            save() {
                axios.post( '/api/chats/' + this.chat.id + '/messages', { body: this.newMessage } )
                    .then( response => response.data )
                    .then( this.addMessage );
            },

            addMessage( message ) {
                this.activePeer = false;

                this.chat.messages.push( message );

                this.newMessage = '';
            }
        }
    };
</script>
