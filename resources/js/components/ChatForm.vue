<template>
    <div class="input-group">
        <input id="btn-input" onkeyup="checkEmptyField();" type="text" name="message" class="form-control input-sm" style="margin-right: 5px" v-model="newMessage" @keyup.enter="sendMessage">
        <span class="input-group-btn">
            <button class="btn btn-primary btn-md" id="btn-chat" @click="sendMessage" disabled>
                Enviar
            </button>
        </span>
    </div>
</template>

<script>

    export default {
        props: ['user'],
        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage,
                });

                this.newMessage = ''
            }
        }
    }
</script>
