<template>
  <div class="mainHeader container mt-3 pb-3">
    <h1>Quiz: {{title}}</h1>
    <div class="headerBar">
      <span>Est. Length: 2:00:00</span>
      <span class="ml-5">My Name: Attempt 1</span>
    </div>


  </div>
</template>

<script>
export default {
  name: "QuizHeader",
  props: ['title'],
}
</script>

<style scoped>
  .mainHeader {
    border-bottom: solid 2px #282828;
    padding-left: 0;
  }
  .headerBar {
    display: inline-block;

  }
</style>