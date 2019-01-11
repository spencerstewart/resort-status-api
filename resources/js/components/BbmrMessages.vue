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
    // import Echo from 'laravel-echo';
    // import Pusher from 'pusher-js';
    export default {
        mounted() {
            console.log('Component mounted.');
            window.Echo.channel("messages-channel")
                .listen('NewMessage', event => {
                    this.messages.unshift(event.message);
                    if (! ('Notification' in window)) {
                        alert('Web Notification is not supported');
                        return;
                    }

                    let notificationBody = event.message.message.replace(/(:?<span.*<\/span>)/gm, '');
                    notificationBody = notificationBody.replace(/<(?:.|\n)*?>/gm, '');
                    notificationBody = notificationBody.replace(/\&nbsp;/gm, ' ');
                    console.log("[unedited message]", event.message.message);
                    console.log("[edited message]", notificationBody);

                    Notification.requestPermission( permission => {
                        let notification = new Notification('BBMR Update', {
                            body: notificationBody, // content for the alert
                            icon: "https://files.bigbearmountainresort.com/resources/BBMR_Logo_Black_on_White_512x512.jpg" // optional image url
                        });

                        // link to page on clicking the notification
                        notification.onclick = () => {
                            window.open(window.location.href);
                        };
                    });
                })
        },
        data() {
            return {
                messages: [],
                moment: moment,
                echo: null
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
