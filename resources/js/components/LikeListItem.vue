<template>
    <article class="border-b-2 last:border-b border-gray-300 bg-white mb-2">
        <header class="flex items-center cursor-pointer pt-6 px-8 " @click="openProfile">
            <img class="rounded-full w-10 h-10" :src="like.author_avatar_url">
            <div class="ml-2 leading-tight">
                <p class="text-sm font-bold md:inline-block">
                    {{ like.author_name }}
                </p>
                <span class="inline-block md:ml-1 text-xs text-gray-600 font-normal">
                    @{{ like.author_username }}
                </span>
                <a :href="`https://twitter.com/${this.like.author_username}/status/${this.like.twitter_id}`" target="_blank" class="inline-block inline-block text-xs text-gray-600 hover:text-blue-500 font-normal">
                    • {{ like.created_at }}
                </a>
            </div>
        </header>
        <div class="px-8 pt-4 pb-6">
            <div class="mb-4" v-html="like.text"></div>
            <div v-if="like.media">
                <div v-for="image in like.media" :key="image.id" class="mb-5">
                    <a :href="image.media_url_https" target="_blank">
                        <div class="w-full h-64 rounded bg-cover bg-center border border-gray-400" :style="`background-image: url('${image.media_url_https}')`"></div>
                    </a>
                </div>
            </div>
            <div v-if="like.urls">
                <a class="block mb-2 flex items-center text-sm text-blue-500 hover:text-blue-700 underline group truncate" v-for="url in like.urls" :key="url.id" :href="url.expanded_url" target="_blank" @click.stop>
                    <svg class="mr-2 fill-current text-blue-500 group-hover:text-blue-700 flex-shrink-0" width="15" height="15" xmlns="http://www.w3.org/2000/svg"><g fill-rule="nonzero"><path d="M13.632 1.756A2.976 2.976 0 0011.542.9c-.788 0-1.538.311-2.09.856L6.554 4.633a.558.558 0 000 .817.577.577 0 00.828 0L10.3 2.572c.335-.33.789-.505 1.262-.505s.927.175 1.262.505c.335.33.513.778.513 1.245 0 .466-.178.914-.513 1.244L9.886 7.94a.558.558 0 000 .817.606.606 0 00.414.175.606.606 0 00.414-.175l2.918-2.878a2.893 2.893 0 00.868-2.061c0-.778-.296-1.498-.868-2.061zM7.618 10.175L4.7 13.053c-.335.33-.789.505-1.262.505s-.927-.175-1.262-.505a1.737 1.737 0 01-.513-1.245c0-.466.178-.914.513-1.244l2.918-2.878a.558.558 0 000-.817.577.577 0 00-.828 0L1.368 9.747A2.815 2.815 0 00.5 11.808c0 .778.315 1.517.868 2.061a2.976 2.976 0 002.09.856c.788 0 1.538-.311 2.09-.856l2.918-2.877a.558.558 0 000-.817.601.601 0 00-.848 0z"/><path d="M4.877 10.408a.606.606 0 00.415.175.606.606 0 00.414-.175l4.417-4.355a.558.558 0 000-.817.577.577 0 00-.829 0L4.877 9.572a.581.581 0 000 .836z"/></g></svg>
                    {{ url.expanded_url | trimLink }}
                </a>
            </div>
        </div>
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
    filters: {
        trimLink(link) {
            if (link.length < 40) return link;
            return `${link.substring(0,50)}...`;
        }
    },
    methods: {
        openProfile() {
            window.open(`https://twitter.com/${this.like.author_username}`, "_blank");
        }
    }
}
</script>