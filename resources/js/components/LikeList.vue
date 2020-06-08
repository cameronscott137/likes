<template>
    <main class="max-w-lg mx-auto">
        <section class="shadow bg-white">
            <like-list-item v-for="like in likesArray" :key="like.id" :like="like"></like-list-item>
        </section>
    </main>
</template>

<script>
import LikeListItem from './LikeListItem';
export default {
    name: 'like-list',
    components: {LikeListItem},
    props: ['likes'],
    data() {
        return {
            likesArray: this.likes
        }
    }
}
</script>