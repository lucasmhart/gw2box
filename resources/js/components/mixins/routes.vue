import Vue from 'vue'
<script>
export default {
  methods: {
    baseRoute() {
      return $('meta[name="base-url"]').attr("content");
    }
  }
};
</script>
