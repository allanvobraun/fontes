<template>
  <div class="wrapper">
    <side-bar></side-bar>
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

export default {
  name: "MainApp",
  components: {
    CardBody,
    SideBar,
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
