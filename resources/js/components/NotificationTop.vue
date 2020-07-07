<template>
  <notifications group="alert" position="top center" width="100%">
    <template slot="body" slot-scope="props">
      <div>
        <b-alert @dismissed="props.close" :variant="props.item.type" show>
          <h5 class="alert-heading">{{props.item.title}}</h5>
          <p>{{props.item.text}}</p>
        </b-alert>
      </div>
    </template>
  </notifications>
</template>

<script>
export default {};
</script>

<style>
</style>