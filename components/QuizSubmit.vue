<template>
  <div class="col-md-12 d-inline">
    <div class="mb-5">
      <h2 class="mb-3">Quiz Submissions - {{quizName}}</h2>
      <p class="mb-4"><b>My Name</b></p>
      <p class="mb-3"><b>Attempt 1</b></p>
      <p>Written: {{formatDate(startTime)}} {{formatAMPM(startTime)}} - {{formatDate(endTime)}} {{formatAMPM(endTime)}}</p>
    </div>

    <router-link to="/" type="button" class="d2l-button">Done</router-link>
  </div>
</template>

<script>
export default {
  name: "QuizSubmit",
  props: ['quizName', 'startTime'],
  data() {
    return {
      endTime: new Date(),
    }
  },
  methods: {
    /* Function: formatAMFM
       Description: Returns the time from the date parameter in 12-hour clock format
       Source: User 'OnlyZero' on stackoverflow.com
       Retrieved from: https://stackoverflow.com/a/64895819
     */
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
    formatDate(date) {
      return date.toDateString().replace(date.toDateString().split(" ")[0], "")
      .replace(" " + date.getFullYear(), ", " + date.getFullYear());
    }
  }
}

</script>
