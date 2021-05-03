<template>
  <div class="mb-1 quizNav mb-3 mr-2">
    <p class="number"><a @click="doSomething">{{displayNum}}</a></p>
    <p class="dots" v-if="!isAnswered">--</p>
    <b-icon-check class="h2 chck" v-if="isAnswered"></b-icon-check>

  </div>
</template>

<script>
import { BIconCheck } from 'bootstrap-vue'

export default {
  name: "QuizNav",
  props: ['num', 'displayNum'],
  components: {BIconCheck},
  data() {
    return {
      isAnswered: false,
    }
  },
  mounted() {
    window.$nuxt.$on('questionSelected', (e) => {
      if (e.questionId === this.num) {
        this.isAnswered = true;
      }
    })
  },
  methods: {
    doSomething() {

    }
  }
}
</script>

<style>
.chck {
  margin-left: -6px;
  text-align: center;
}
.quizNav {
  border: 1px solid #50585c;
  border-radius: 6px;
  vertical-align: middle;
  text-align: center;
  padding: 10px;
  width: 42px;
  height: 80px;
}
.number {
  margin-bottom: 5px;
  color: #48a8ed;
  font-size: 16px;
}
.dots {
  font-weight: 700;
  font-size: 25px;
  margin-bottom: 2px;
}
</style>