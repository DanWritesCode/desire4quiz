<template>
  <div>
    <quiz-description v-if="Object.keys(quizInfo).length > 0 && !quizBegun" :title="quizInfo.title" :description="quizInfo.description" :time-allowed="quizInfo.timeAllowed"></quiz-description>
    <quiz-header v-if="showQuizHeader && quizBegun"></quiz-header>
    <quiz-frame v-if="quizBegun" :quiz-id="quizId"></quiz-frame> <!-- hardcoded value "1" for testing purposes -->
  </div>
</template>

<script>
import QuizHeader from "@/components/QuizHeader";
import QuizFrame from "@/components/QuizFrame";
import QuizDescription from "@/components/QuizDescription";
import {API_URL} from "@/config";

export default {
  name: 'Quiz',
  transition: 'fade',
  components: {QuizDescription, QuizHeader, QuizFrame},
  data() {
    return {
      quizId: this.$route.params.quiz,
      quizBegun: false,
      showQuizHeader: true,
      quizInfo: {},
    }
  },
  head() {
    return {
      title: 'Desire4Quiz | Quiz'
    }
  },
  mounted() {
    if(this.quizId > 0) {
      this.$axios.$get(`${API_URL}/quiz/${this.quizId}`)
          .then((res) => {
            console.log(res);
            this.quizInfo = res;
          }).catch((e) => {
            if(e.response && e.response.status === 404)
              this.$swal({title: 'Invalid quiz!', text: 'This quiz does not exist!', icon: 'error', showConfirmButton: false, showCancelButton: false, buttons: false});
            else
              this.$swal({title: 'Error!', text: 'Error connecting to the Quiz server! Please reload the page.', icon: 'error'});
      })
    } else {
      this.$swal({title: 'Invalid quiz!', text: 'You have entered a quiz ID that cannot be processed!', icon: 'error', showConfirmButton: false, showCancelButton: false, buttons: false});
    }
    window.$nuxt.$on('startQuiz', (e) => {
      this.showQuizHeader = true;
      this.quizBegun = true;
    })
    window.$nuxt.$on('submitQuiz', (e) => {
      this.showQuizHeader = false;
    })
  }
}
</script>
<style>


</style>