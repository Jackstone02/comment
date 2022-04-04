<template>
    <div class="form-group">
        <input type="text" class="form-control mb-2" v-model="form.name" placeholder="Name" />
        <textarea class="form-control mb-2" v-model="form.message" placeholder="Message"></textarea>
        <div class="text-end">
            <button type="button" class="btn btn-light" @click="cancelReply">Cancel</button>
            <button type="button" class="btn btn-primary" @click="addComment">Comment</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['type', 'data'],
        data() {
            return {
                form: {
                    name: null,
                    message: null
                },
            }
        },
        mounted() {

        },
        methods: {
            addComment() {
                if( this.type == 'first' ) {
                    axios.post('/api/comment/save', this.form)
                    .then(response => {
                        this.cancelReply();
                        this.$emit('getAllComments')
                    })
                    .catch(err => {

                    })

                } else if( this.type == 'second' ) {
                    this.form.comment_id = this.data.id;
                    axios.post('/api/secondary-comment/save', this.form)
                    .then(response => {
                        this.cancelReply();
                        this.$emit('getAllComments')
                    })
                    .catch(err => {

                    })

                } else {
                    this.form.secondary_comment_id = this.data.id;
                    axios.post('/api/tertiary-comment/save', this.form)
                    .then(response => {
                        this.cancelReply();
                        this.$emit('getAllComments')
                    })
                    .catch(err => {

                    })
                }
                
            },
            cancelReply() {
                this.$emit('cancelReply', {
                    data: this.data,
                    type: this.type,
                })
            }
        }
    }
</script>
