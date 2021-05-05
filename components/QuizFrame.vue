<template>
  <div class="mainQuiz container mt-5 mb-5">
    <div class="row">
      <div class="col-md-2 d-inline" v-if="!quizSubmit">
        <p><b>Page 1:</b></p>
        <div class="container">
          <div class="row">
            <quiz-nav v-for="(question, index) in questions" v-bind:key="question.id" :question-id="question.id" :display-num="index+1"></quiz-nav>
          </div>
        </div>
      </div>

      <div class="col-md-8 ml-5 d-inline" v-if="!quizPresubmit && !quizSubmit">
        <div v-for="(question, index) in questions" class="mb-5" :ref="'q'+question.id">
          <h5><b>Question {{index+1}}</b> ({{question.marks}} point)</h5>
          <p>{{ question.question }}</p>
          <quiz-answer v-for="answer in question.answers" v-bind:key="answer.id" :text="answer.answerText" :question-id="question.id" :answer-id="answer.id"></quiz-answer>
        </div>
        <br/>
        <hr style="background-color: #303133; height: 1px;"/>
        <div class="d-inline">
          <button type="button" class="d2l-button mt-2" @click="presubmitQuiz">Submit Quiz</button>
          <span class="small">{{counter}} of {{questions.length}} questions saved</span>
        </div>
      </div>
      <quiz-presubmit v-if="quizPresubmit && !quizSubmit" :quiz-id="quizId" :selected-questions="selectedQuestions"></quiz-presubmit>
      <quiz-submit v-if="quizSubmit" :start-time="startTime" :title="title" :submission-response="quizSubmissionResponse"></quiz-submit>
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
  props: ['quizId', 'title'],
  data() {
    return {
      questions: [],
      selectedQuestions: {},
      counter: 0,
      quizPresubmit: false,
      quizSubmit: false,
      startTime: new Date(),
      quizSubmissionResponse: {},
    }
  },
  methods: {
    presubmitQuiz() {
      this.quizPresubmit = true;
    }
  },
  async mounted() {
    window.$nuxt.$on('questionSelected', (e) => {
      if(!this.selectedQuestions[e.questionId])
        this.counter++;

      this.selectedQuestions[e.questionId] = e.answerId;
    })
    window.$nuxt.$on('abortSubmission', () => {
      this.quizPresubmit = false;
    })
    window.$nuxt.$on('scrollToQuestion', (e) => {
      if(this.$refs['q' + e.questionId]) {
        const el = this.$refs['q' + e.questionId][0];
        if (el)
          el.scrollIntoView({behavior: 'smooth'});
      }
    })
    window.$nuxt.$on('submitQuiz', (e) => {
      this.quizSubmissionResponse = e.response;
      this.quizPresubmit = false;
      this.quizSubmit = true;
    })
    await this.$axios.$post(`${API_URL}/quiz/${this.quizId}`, "")
        .then((res) => {
          this.questions = res.questions;
        }).catch(() => {
          this.$swal({title: 'Error!', text: 'Unable to connect to the Quiz server! Please reload the page.', icon: 'error'});
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