<template>
    <ul class="nav nav-tabs">
        <li class="nav-item" v-for="(item, index) in menuItems" :key="index">
            <router-link class="nav-link" :to="{name: item.routeName}">{{item.label}}</router-link>
        </li>
    </ul>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            menuItems: [
                {
                    label: 'Home',
                    routeName: 'home',
                },
                {
                    label: 'All Posts',
                    routeName: 'posts',
                },
                {
                    label: 'About Us',
                    routeName: 'about',
                },
                {
                    label: 'Contacts Us',
                    routeName: 'contacts',
                },
            ]
        }
    }
}
</script>

<style lang="scss">

</style>
