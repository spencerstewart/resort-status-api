<template>
    <div class="row">
        <div class="col-md">
            <div class="card"
                v-for="message in messages">
                <div class="card-header">
                    <span class="font-weight-bold">{{ message.from }}</span> - {{ moment(message.updated_at).fromNow() }}
                </div>
                <div class="card-body">
                    <p class="card-text" v-html="message.message"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        },
        data() {
            return {
                messages: [],
                moment: moment
            }
        },
        created() {
            axios.get('/api/messages')
            .then(response => {
                this.messages = response.data;
            })
        }
    }
</script>
