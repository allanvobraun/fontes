<template>
  <div>
    <div class="wrapper">
      <side-bar></side-bar>

      <main class="m-4 w-100">
        <card-body>
            <router-view></router-view>
        </card-body>
      </main>
    </div>
  </div>
</template>

<script>
import CardBody from "./CardBody.vue";
import SideBar from "./SideBar.vue";

export default {
  components: {
    CardBody,
    SideBar
  }
};
</script>

<style>
.wrapper {
  display: flex;
  width: 100%;
  align-items: stretch;
}
</style>