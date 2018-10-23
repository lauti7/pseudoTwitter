<template lang="html">
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notificaciones <span class="badge badge-primary">{{ notifications.length }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a :href="'/' + notification.data.follower.username " class="dropdown-item" v-for="notification in notifications">
                {{ notification.data.follower.username }} te ha seguido!
            </a>

        </div>
    </li>
</template>

<script>
export default {
    props:['user'],
    data(){
        return {
            notifications: [],
        }
    },
    mounted(){
        console.log('Montado');
        axios.get('/api/notifications')
            .then(response => {
                this.notifications = response.data;
                Echo.private(`App.User.${this.user}`)
                    .notification(notification => {
                        this.notifications.unshift(notification);
                    });
            });

    }
}
</script>

<style lang="css">
</style>
