<template>
  <div>
    <quiz-header v-if="showQuizHeader"></quiz-header>
    <quiz-frame :quiz-id="1"></quiz-frame> <!-- hardcoded value "1" for testing purposes -->
  </div>
</template>

<script>
import QuizHeader from "~/components/QuizHeader";
import QuizFrame from "~/components/QuizFrame";

export default {
  name: 'Quiz',
  transition: 'fade',
  components: {QuizHeader, QuizFrame},
  data() {
    return {
      showQuizHeader: true,
    }
  },
  head() {
    return {
      title: 'Desire4Quiz | Quiz'
    }
  },
  mounted() {
    window.$nuxt.$on('submitQuiz', (e) => {
      this.showQuizHeader = false;
    })
  }
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