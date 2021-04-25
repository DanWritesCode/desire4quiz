<template>
  <div>
    <home-page></home-page>
  </div>
</template>

<script>
import HomePage from '../components/HomePage'
export default {
  name: 'Home',
  components: { HomePage },
  transition: 'fade',
  head() {
    return {
      title: 'Desire4Quiz | Home'
    }
  },
}
</script>
<style>
body {
  background-color: #191919;
  font-family: 'Lato', sans-serif;
  color: #bcbfc0;
  font-size: 19px;
  letter-spacing: .01rem;
  font-weight: 400;
  line-height: 1.4rem;
}
</style>