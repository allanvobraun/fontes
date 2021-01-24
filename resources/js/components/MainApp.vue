<template>
  <div class="wrapper">
    <side-bar></side-bar>
    <notification-top></notification-top>
    <main class="w-100">
      <card-body>
        <router-view></router-view>
      </card-body>
    </main>
  </div>
</template>

<script>
import CardBody from "./CardBody.vue";
import SideBar from "./SideBar.vue";
import NotificationTop from './NotificationTop';

export default {
  name: "MainApp",
  components: {
    CardBody,
    SideBar,
    NotificationTop
  }
}
</script>

<style scoped>
.wrapper {
  display: flex;
  width: 100%;
  align-items: stretch;
}

main {
  margin: 0.6rem 1.3rem;
}
</style>
