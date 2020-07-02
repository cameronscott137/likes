<template>
    <section class="md:mx-0 mx-4">
        <like-list-item v-for="like in likesArray" :key="like.id" :like="like"></like-list-item>
        <div v-if="likesArray.length == 0" class="border-b-2 last:border-b border-gray-300 bg-white mb-2 px-12 py-8 text-center">
            <h2 class="text-lg font-bold mb-2">No tweets match your search</h2>
            <p>You can search by the text of the tweet, the author's name, or their username.</p>
        </div>
    </section>
</template>

<script>
import LikeListItem from './LikeListItem';
export default {
    name: 'like-list',
    components: {LikeListItem},
    props: ['likes'],
    data() {
        return {
            likesArray: this.likes,
            loadingFeed: false,
            offset: 40,
            searchTerm: '',
        }
    },
    methods: {
        watchScroll (person) {
            window.addEventListener('scroll', () => {
                let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
                if (!bottomOfWindow) return;
                if (this.loadingFeed) return;
                this.loadingFeed = true
                axios.get(`${window.origin}?offset=${this.offset}&term=${this.searchTerm}`)
                    .then(response => {
                        this.likesArray = this.likesArray.concat(response.data)
                        this.offset = (this.offset + 40)
                    })
                    .catch((error) => {
                        console.log(error);
                    }).finally(() => {
                        this.loadingFeed = false
                    });
        });
        }
    },
    mounted() {
        this.watchScroll();
        var url = new URL(window.location);
        this.searchTerm = url.searchParams.get("term");
    }
}
</script>