<template>
  <router-link to="quiz" type="button" class="d2l-button">{{title}}</router-link>
</template>

<script>
export default {
  name: "D4QButton",
  props: ['title', 'destination'],
}
</script>

<style scoped>

</style>