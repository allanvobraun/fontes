<template >

  <div class="text-center">
    <b-badge variant="primary" class="p-2">
      {{text}}
      <b-badge variant="light">{{number}}</b-badge>
    </b-badge>
  </div>

</template>

<script>
  export default {
    name: "NumberBadge",
    props: {
      text: {
        type: String
      },
      number: {
        type: Number
      }
    }
  }
</script>

<style scoped>
  * {
    font-size: 1.2rem;
  }

</style>
