<template>
  <div class="mx-5">
    <b-form>
      <div class="row">
        <b-form-group label="N/S Rework:" class="col-sm-6">
          <auto-complete-n-s-rework></auto-complete-n-s-rework>
        </b-form-group>
      </div>
    </b-form>
  </div>
</template>

<script>
  import AutoCompleteNSRework from "components/search/AutoCompleteNSRework";
  export default {
    name: "EditorFontes",
    components: { AutoCompleteNSRework }
  }
</script>

<style scoped>

</style>
