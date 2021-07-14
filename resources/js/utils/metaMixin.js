import {mapMutations} from "vuex";
export default {
  methods: {
    ...mapMutations('meta', ['setTitle']),
  },
  computed: {
    title() {
      return '';
    }
  },
  watch: {
    title: {
      immediate: true,
      handler(newValue) {
        this.setTitle(newValue);
      }
    }
  }
}
