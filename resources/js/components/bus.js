import Vue from 'vue'
export default new Vue({
  methods: {
    setIsObjectUpdating(value) {
      this.$emit('changeIsObjectUpdating', value)
    },
    whenIsObjectUpdatingChange(callback) {
      this.$on('changeIsObjectUpdating', callback)
    }
  },
})
