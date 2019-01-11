<template>
  <div v-show="notificationsEnabled">
    <h1>Notifications are enabled.</h1>
  </div>
</template>

<script>
    // import Echo from 'laravel-echo';
    // import Pusher from 'pusher-js';
    export default {
        mounted() {
            
        },
        data() {
            return {
                notificationsEnabled: false
            }
        },
        created() {
            const messaging = firebase.messaging();

            
            
            messaging.requestPermission()
            .then(function() {
              console.log('[Firebase Messaging] Notification permission granted');
              return messaging.getToken();
            })
            .then(function(token) {
              console.log(token);
            })
            .catch(function(err) {
              console.log('[Firebase Messaging: Error]', err);
            })

        }
    }
</script>