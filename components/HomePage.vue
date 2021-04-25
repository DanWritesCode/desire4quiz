<template>
  <div class="container mt-5" >
    <h1>Summary - Quiz: My Custom Quiz</h1>
    <h2 class="mt-4">Description</h2>
    <p>This is a test quiz</p>
    <h2 class="mt-4 mb-4">Quiz Details</h2>
    <h6>Current Time</h6>
    <label>10:16 PM</label>
    <h6>Time Allowed</h6>
    <label>Unlimited (estimated time required: 2:00:00)</label>
    <h2 class="mt-4">Instructions</h2>
    <p>Desire4Quiz will automatically save your answers in your browser as you work through the quiz.
      You can submit your quiz responses at any time.
      Click "Start Quiz" to begin attempt.</p>
    <div class="mt-4">
      <d4-q-button title="Start Quiz!" destination="quiz"></d4-q-button>
    </div>
  </div>
</template>

<script>
import D4QButton from "~/components/D4QButton";
export default {
  name: "HomePage",
  components: {D4QButton}
}
</script>

<style scoped>

</style>