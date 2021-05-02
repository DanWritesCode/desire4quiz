<template>
  <div class="container mt-5" >
    <h1>Summary - Quiz: {{title}}</h1>
    <h2 class="mt-4">Description</h2>
    <p>{{description}}</p>
    <h2 class="mt-4 mb-4">Quiz Details</h2>
    <h6>Current Time</h6>
    <label>{{formatAMPM(new Date())}}</label>
    <h6>Time Allowed</h6>
    <label>{{getTimeAllowed()}}</label>
    <h2 class="mt-4">Instructions</h2>
    <p>Desire4Quiz will automatically save your answers in your browser as you work through the quiz.
      You can submit your quiz responses at any time.
      Click "Start Quiz" to begin attempt.</p>
    <div class="mt-4">
      <button type="button" class="d2l-button" @click="startQuiz">Submit Quiz</button>
    </div>
  </div>
</template>

<script>
import D4QButton from "~/components/D4QButton";
export default {
  name: "QuizDescription",
  props: ['title', 'description', 'timeAllowed'],
  components: {D4QButton},
  methods: {
    formatAMPM(date) {
      let hours = date.getHours();
      let minutes = date.getMinutes();
      const ampm = hours >= 12 ? 'PM' : 'AM';

      hours %= 12;
      hours = hours || 12;
      minutes = minutes < 10 ? `0${minutes}` : minutes;

      const strTime = `${hours}:${minutes} ${ampm}`;

      return strTime;
    },
    getTimeAllowed() {
      if(this.timeAllowed === 0)
        return "Unlimited (estimated time required: 2:00:00)";
      else
        return this.timeAllowed + " minutes";
    },
    startQuiz() {
      window.$nuxt.$emit('startQuiz', {});
    }
  }
}
</script>