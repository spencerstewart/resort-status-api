<template>
    <div class="row">
        <div class="col-md">
            <div class="card"
                style=""
                v-for="motd in motds"
            >
                <div class="card-body">
                    <h5>{{motd.from}} - <span class="rs-post-time">{{ moment(motd.updated_at).fromNow()}}</span></h5>
                    <p v-html="motd.message"></p>
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
                motds: [],
                moment: moment
            }
        },
        created() {
            axios.get('/api/motds')
            .then(response => {
                this.motds = response.data;
                console.log(this.motds);
            })
        }
    }
</script>
