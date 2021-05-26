<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix" id="chatespace">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                    <span class="text-diff pull-right"><em>{{ message.created_at | timeago }}</em></span>
                </div>
                <div style="background-color: #ECF4F4">
                    <p>
                        {{ message.message }}
                    </p>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>

    moment.locale('es');

    export default {
        props: ['messages'],
        filters: {
            timeago(value) {
                return moment.utc(value).local().fromNow()
            }
        }
    };

</script>
