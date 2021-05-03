<template>
  <div class="col-md-12 d-inline">
    <div class="mb-5">
      <h2 class="mb-3">Quiz Submissions - {{title}}</h2>
      <p class="mb-4"><b>My Name</b></p>
      <p class="mb-3"><b>Attempt 1</b></p>
      <p>Written: {{formatDate(startTime)}} {{formatAMPM(startTime)}} - {{formatDate(endTime)}} {{formatAMPM(endTime)}}</p>
    </div>
    <div v-if="autoGrade" style="border-top: #394047 1px solid;">
      <div class="text-right mt-2 mt-3">
        <p class="mb-2"><b>Attempt Score: </b>{{gradeAchievedMarks}} / {{gradeTotalMarks}} - {{ (gradePercentage * 100).toFixed(2)}} %</p>
        <p><b>Overall Grade </b>(highest attempt): {{gradeAchievedMarks}} / {{gradeTotalMarks}} - {{ (gradePercentage * 100).toFixed(2)}} %</p>
      </div>
    </div>
    <router-link to="/" type="button" class="d2l-button">Done</router-link>
  </div>
</template>

<script>
export default {
  name: "QuizSubmit",
  props: ['title', 'startTime', 'submissionResponse'],
  data() {
    return {
      endTime: new Date(),
      autoGrade: false,
      gradeTotalMarks: 0,
      gradeAchievedMarks: 0,
      gradePercentage: 0,
    }
  },
  mounted() {
    if(Object.keys(this.submissionResponse).length > 0) {
      if(this.submissionResponse.autoGrade) {
        this.autoGrade = true;
        this.gradeTotalMarks = this.submissionResponse.grade.totalMarks;
        this.gradeAchievedMarks = this.submissionResponse.grade.marks;
        this.gradePercentage = this.submissionResponse.grade.percentage;
      }
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
    },
  }
}

</script>
