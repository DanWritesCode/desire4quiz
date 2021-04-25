<template>
  <div class="mainQuiz container mt-5 mb-5">
    <div class="row">
      <div class="col-md-2 d-inline" v-if="!quizSubmit">
        <p><b>Page 1:</b></p>
        <div class="container">
          <div class="row">
            <quiz-nav num="1"></quiz-nav>
            <quiz-nav num="2"></quiz-nav>
            <quiz-nav num="3"></quiz-nav>
            <quiz-nav num="4"></quiz-nav>
            <quiz-nav num="5"></quiz-nav>
            <quiz-nav num="6"></quiz-nav>
          </div>
        </div>
      </div>

      <div class="col-md-8 ml-5 d-inline" v-if="!quizPresubmit && !quizSubmit">
        <div class="mb-5">
          <h5><b>Question 1</b> (1 point)</h5>
          <p>The best way to get good grades is to:</p>
          <quiz-answer text="Study Hard" question-id="1"></quiz-answer>
          <quiz-answer text="Watch Netflix" question-id="1"></quiz-answer>
          <quiz-answer text="Enter a pizza-eating contest" question-id="1"></quiz-answer>
          <quiz-answer text="Sleep" question-id="1"></quiz-answer>
        </div>
        <div class="mb-5">
          <h5><b>Question 2</b> (1 point)</h5>
          <p>The fastest way to get rich quick is to:</p>
          <quiz-answer text="Work hard" question-id="2"></quiz-answer>
          <quiz-answer text="Start a ponzi scheme" question-id="2"></quiz-answer>
          <quiz-answer text="Multi-level marketing" question-id="2"></quiz-answer>
          <quiz-answer text="Buy Dogecoin" question-id="2"></quiz-answer>
        </div>
        <div class="mb-5">
          <h5><b>Question 3</b> (1 point)</h5>
          <p>Best girl:</p>
          <quiz-answer text="Taiga Aisaka" question-id="3"></quiz-answer>
          <quiz-answer text="Mami-chan" question-id="3"></quiz-answer>
          <quiz-answer text="Yuno Gasai" question-id="3"></quiz-answer>
          <quiz-answer text="Chika Fujiwara" question-id="3"></quiz-answer>
        </div>
        <div class="mb-5">
          <h5><b>Question 4</b> (1 point)</h5>
          <p>Best programming language:</p>
          <quiz-answer text="Fortran" question-id="4"></quiz-answer>
          <quiz-answer text="C/C++" question-id="4"></quiz-answer>
          <quiz-answer text="Java" question-id="4"></quiz-answer>
          <quiz-answer text="Python" question-id="4"></quiz-answer>
        </div>
        <div class="mb-5">
          <h5><b>Question 5</b> (1 point)</h5>
          <p>Best operating system:</p>
          <quiz-answer text="Windows 10" question-id="5"></quiz-answer>
          <quiz-answer text="Windows XP" question-id="5"></quiz-answer>
          <quiz-answer text="Ubuntu" question-id="5"></quiz-answer>
          <quiz-answer text="Mac OS" question-id="5"></quiz-answer>
        </div>
        <div class="mb-5">
          <h5><b>Question 6</b> (1 point)</h5>
          <p>Greatest game of all time:</p>
          <quiz-answer text="Minecraft" question-id="6"></quiz-answer>
          <quiz-answer text="see above answer" question-id="6"></quiz-answer>
          <quiz-answer text="see above answer" question-id="6"></quiz-answer>
          <quiz-answer text="see above answer" question-id="6"></quiz-answer>
        </div>
        <br/>
        <hr style="background-color: #303133; height: 1px;"/>
        <div class="d-inline">
          <button type="button" class="d2l-button mt-2" @click="presubmitQuiz">Submit Quiz</button>
          <span class="small">{{counter}} of 69 questions saved</span>
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


export default {
  name: "QuizHeader",
  components: {QuizSubmit, QuizPresubmit, QuizNav, QuizAnswer},
  props: [],
  data() {
    return {
      selectedQuestions: new Array(69),
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
  mounted() {
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
  },
}
</script>

<style scoped>
  .mainQuiz {
    padding-left: 0;
    font-size: 19px;
  }
</style>