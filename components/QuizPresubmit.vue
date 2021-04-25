<template>
  <div class="col-md-8 ml-5 d-inline">
    <div class="mb-5">
      <h2 class="mb-3">Quiz Submission Confirmation</h2>
      <p class="mb-3 ml-3">You are about to submit your quiz...</p>
      <p class="ml-3">Once you press the Submit Quiz button you cannot return to your quiz.</p>
    </div>
    <hr style="background-color: #303133; height: 1px;"/>

    <div class="d-inline">
      <button type="button" class="d2l-button" @click="submitQuiz">Submit Quiz</button>
      <button type="button" class="d2l-regular-button" @click="abortSubmission">Back to Questions</button>

    </div>
  </div>
</template>

<script>
export default {
  name: "QuizPresubmit",
  methods: {
    submitQuiz() {
      window.$nuxt.$emit('submitQuiz', {
      });
    },
    abortSubmission() {
      window.$nuxt.$emit('abortSubmission');
    }
  }
}
</script>
