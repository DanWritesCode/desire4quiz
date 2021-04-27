<template>
  <div class="mainQuiz container mt-5 mb-5">
    <div class="row">
      <div class="col-md-2 d-inline" v-if="!quizSubmit">
        <p><b>Page 1:</b></p>
        <div class="container">
          <div class="row">
            <quiz-nav v-for="question in questions" :num="question.id"></quiz-nav>
          </div>
        </div>
      </div>

      <div class="col-md-8 ml-5 d-inline" v-if="!quizPresubmit && !quizSubmit">
        <div v-for="question in questions" class="mb-5">
          <h5><b>Question {{question.id}}</b> ({{question.marks}} point)</h5>
          <p>{{ question.question }}</p>
          <quiz-answer v-for="answer in question.answers" :text="answer.answerText" :question-id="question.id"></quiz-answer>
        </div>
        <br/>
        <hr style="background-color: #303133; height: 1px;"/>
        <div class="d-inline">
          <button type="button" class="d2l-button mt-2" @click="presubmitQuiz">Submit Quiz</button>
          <span class="small">{{counter}} of {{questions.length}} questions saved</span>
        </div>
      </div>
      <quiz-presubmit v-if="quizPresubmit && !quizSubmit"></quiz-presubmit>
      <quiz-submit v-if="quizSubmit" quiz-name="My Custom Quiz"></quiz-submit>
    </div>
  </div>
</template>

<script>
import QuizAnswer from "~/components/QuizAnswer";
import QuizNav from "~/components/QuizNav";
import QuizPresubmit from "@/components/QuizPresubmit";
import QuizSubmit from "@/components/QuizSubmit";
import { API_URL } from '@/config.js'

export default {
  name: "QuizHeader",
  components: {QuizSubmit, QuizPresubmit, QuizNav, QuizAnswer},
  props: ['quizId'],
  data() {
    return {
      questions: [],
      selectedQuestions: [],
      counter: 0,
      quizPresubmit: false,
      quizSubmit: false,
    }
  },
  methods: {
    presubmitQuiz() {
      this.quizPresubmit = true;
    }
  },
  async mounted() {
    window.$nuxt.$on('questionSelected', (e) => {
      if(!this.selectedQuestions.includes(e.questionId)) {
        this.selectedQuestions.push(e.questionId);
        this.counter++;
      }
    })
    window.$nuxt.$on('abortSubmission', (e) => {
      this.quizPresubmit = false;
    })
    window.$nuxt.$on('submitQuiz', (e) => {
      this.quizSubmit = true;
    })
    await this.$axios.$post(`${API_URL}/quiz/${this.quizId}`, "")
        .then((res) => {
          this.questions = res.questions;
        })
  },

}
</script>

<style scoped>
  .mainQuiz {
    padding-left: 0;
    font-size: 19px;
  }
</style>