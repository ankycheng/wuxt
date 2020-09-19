<template>
<div>
    <button class="button btn" @click="click">111</button>
    <div class="editor" v-html="fields.meta.editor[0]"></div>
    <Page v-if="single.type === 'page'" :page="single" />
    <Post v-else :post="single" />
    <div>{{fields.meta}}</div>
    
</div>
</template>

<script>


import Page from '~/components/templates/Page'
import Post from '~/components/templates/Post'

export default {
    mounted() {
    },
    data() {
        return {
            id: null
        }
    },
    methods: {
        click(){
            // console.log('click')
            console.log(this.fields)
        }
    },
    async asyncData(context) {
        const {
            route,
            app,
            error
        } = context

        try {
            const single = await app.$wp.slug().name(route.params.single)
            const fields = await app.$wp.custom_fields().name(route.params.single)
            // setTimeout(()=>{
            //     console.log(single)
            //     console.log(app)
            // },500)
            return {
                single: single,
                dog: "DOOOG",
                fields: fields
            }
        } catch (e) {
            error(e)
        }
    },

    components: {
        Page,
        Post
    }
}
</script>
