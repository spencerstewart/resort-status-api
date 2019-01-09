<template>
    <div class="row">
        <div class="col-md">
            <div class="card"
                style=""
                v-for="motd in motds"
            >
                <div class="card-body">
                    <h5>{{motd.from}}</h5>
                    <p>{{motd.message}}</p>
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
                motds: [
                    {
                        from: 'tom',
                        message: 'hello'
                    }
                ]
            }
        }
    }
</script>
