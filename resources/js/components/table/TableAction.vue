<script>
export default {
  props: {
    identification: String,
  },
  computed: {
    endpoint() {
      return `/fontes/${this.identification}/reparos`;
    }
  }
};
</script>
