<template>
  <div class="col-md-12 d-inline">
    <div class="mb-5">
      <h2 class="mb-3">Quiz Submissions - {{quizName}}</h2>
      <p class="mb-3 ml-3"><b>My Name</b></p>
      <p class="mb-3 ml-3"><b>Attempt 1</b></p>
      <p class="ml-3">Written: From - To</p>
    </div>

    <router-link to="/" type="button" class="d2l-button">Done</router-link>
  </div>
</template>

<script>
export default {
  name: "QuizSubmit",
  props: ['quizName'],
  methods: {
    submitQuiz() {
      window.$nuxt.$emit('submitQuiz', {
        questionId: this.questionId,
        questionText: this.text,
      });
    },
    abortSubmission() {
      window.$nuxt.$emit('abortSubmission');
    }
  }
}
</script>
