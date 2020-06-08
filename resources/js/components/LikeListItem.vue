<template>
    <article class="border-b border-gray-300 p-4">
        <div class="mb-4" v-html="like.text"></div>
        <div v-if="like.media">
            <div v-for="image in like.media" :key="image.id">
                <img :src="image.media_url">
            </div>
        </div>
        <div v-if="like.urls">
            <a class="block text-sm mb-5 text-blue-500 hover:text-blue-700 underline" v-for="url in like.urls" :key="url.id" :href="url.expanded_url" target="_blank" @click.stop>
                {{ url.expanded_url }}
            </a>
        </div>
        <footer class="flex items-center cursor-pointer" @click="openProfile">
            <img class="rounded-full" :src="like.author_avatar_url">
            <div class="ml-2">
                <p class="text-sm font-bold" v-text="like.author_name"></p>
                <p class="text-xs" v-text="like.created_at"></p>
            </div>
        </footer>
    </article>
</template>

<script>
export default {
    props: ['like'],
    data() {
        return {
            likeArray: this.like
        }
    },
    methods: {
        openProfile() {
            window.open(`https://twitter.com/${this.like.author_username}`, "_blank");
        },
        openTweet() {
            window.open(`https://twitter.com/${this.like.author_username}/status/${this.like.twitter_id}`, "_blank");
        }
    }
}
</script>