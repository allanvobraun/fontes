<script>
export default {
  props: {
    fonteObject: Object,
  },
  computed: {
    routeParams() {
      return {
        cod_interno: this.fonteObject.cod_interno,
        id: this.fonteObject.id
      };
    }
  }
};
</script>
