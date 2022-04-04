<template>
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <div class="mb-2">
                            <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <button type="button" class="btn btn-outline-success" @click="commentAdd">+ Add Comment</button>
                        </div>
                        <AddComment
                            v-if="addComment"
                            type="first"
                            :data="null"
                            @cancelReply="cancelReply"
                            @getAllComments="getAllComments"
                        />
                        <hr>
                        <div class="row" v-for="(data, index) in allComments" :key="index">
                            <div class="col-12 pb-3">
                                <span class="fw-bold m-0">{{ data.name }}</span> <span class="text-muted ms-2">{{ data.created_at }}</span>
                                <div>{{ data.message }}</div>
                                <button type="button" class="btn btn-sm nav-link p-0" @click="reply(data, 'second')">Reply</button>
                            </div>
                            <div class="col-12">
                                <div class="row ms-3">
                                    <AddComment
                                        v-if="replySecond.includes(data.id)"
                                        type="second"
                                        :data="data"
                                        @cancelReply="cancelReply"
                                        @getAllComments="getAllComments"
                                     />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row ms-3" v-for="(dta, idx) in data.secondary_comments" :key="idx">
                                    <div class="col-12 pb-3">
                                        <span class="fw-bold m-0">{{ dta.name }}</span> <span class="text-muted ms-2">{{ dta.created_at }}</span>
                                        <div>{{ dta.message }}</div>
                                        <button type="button" class="btn btn-sm nav-link p-0" @click="reply(dta, 'third')">Reply</button>
                                    </div>
                                    <div class="col-12">
                                        <div class="row ms-3">
                                            <AddComment
                                                v-if="replyThird.includes(dta.id)"
                                                type="third"
                                                :data="dta"
                                                @cancelReply="cancelReply"
                                                @getAllComments="getAllComments"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row ms-3" v-for="(d, i) in dta.tertiary_comments" :key="i">
                                            <div class="col-12 pb-3">
                                                <span class="fw-bold m-0">{{ d.name }}</span> <span class="text-muted ms-2">{{ d.created_at }}</span>
                                                <div>{{ d.message }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AddComment from './AddComment.vue';
    export default {
        components: { AddComment },
        data() {
            return {
                allComments: [],
                addComment: false,
                replySecond: [],
                replyThird: []
            }
        },
        mounted() {
            this.getAllComments();
        },
        methods: {
            getAllComments() {
                axios.get('/api/comments')
                .then(response => {
                    this.allComments = response.data.result;
                })
                .catch(err => {

                })
            },
            commentAdd() {
                this.addComment = true;
            },
            reply(data, type) {
                if( type == 'second' ) {
                    if( !this.replySecond.includes(data.id) ) {
                        this.replySecond.push(data.id);
                    }
                } else {
                    if( !this.replyThird.includes(data.id) ) {
                        this.replyThird.push(data.id);
                    }
                }
            },
            cancelReply(data) {
                if( data.type == 'second' ) {
                    let indx = this.replySecond.indexOf(data.data.id);
                    this.replySecond.splice(indx, 1);

                } else if( data.type == 'third' ) {
                    let indx = this.replyThird.indexOf(data.data.id);
                    this.replyThird.splice(indx, 1);

                } else {
                    this.addComment = false;
                }
            }
        }
    }
</script>
