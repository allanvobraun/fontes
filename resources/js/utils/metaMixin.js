import {mapMutations} from "vuex";
export default {
  methods: {
    ...mapMutations('meta', ['setTitle']),
  },
  mounted() {
    this.setTitle(this.title);
  },
  computed: {
    title() {
      return '';
    }
  }
}
