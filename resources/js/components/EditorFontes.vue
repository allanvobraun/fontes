<template>
  <div class="mx-5">
    <b-form ref="search-form">
      <div class="row">
        <b-form-group label="N/S Rework:" class="col-sm-6">
          <auto-complete-n-s-rework></auto-complete-n-s-rework>
        </b-form-group>
        <b-form-group label="N/S Fabricante:" class="col-sm-6">
          <auto-complete-n-s-fabricante></auto-complete-n-s-fabricante>
        </b-form-group>
      </div>
    </b-form>
    <hr/>
    <b-form>
      <div class="row">
        <b-form-group label="Modelo:" class="col-sm-6">
          <edit-input></edit-input>
        </b-form-group>
        <b-form-group label="Fabricante:" class="col-sm-6">
          <edit-input></edit-input>
        </b-form-group>
      </div>
      <div class="row">
        <b-form-group label="Descrição problema:" class="col-sm-6">
          <edit-input></edit-input>
        </b-form-group>
        <b-form-group label="Peças utilizadas:" class="col-sm-6">
          <edit-input></edit-input>
        </b-form-group>
      </div>
    </b-form>
  </div>
</template>

<script>
  import AutoCompleteNSRework from "components/search/AutoCompleteNSRework";
  import AutoCompleteNSFabricante from "components/search/AutoCompleteNSFabricante";
  import { BIconPencilSquare } from 'bootstrap-vue';
  import EditInput from "components/inputs/EditInput";
  export default {
    name: "EditorFontes",
    components: { AutoCompleteNSRework, AutoCompleteNSFabricante, EditInput}
  }
</script>

<style scoped>

</style>
