<template>
  <div :class="{ 'is-active': isToggled }" class="form-check answer-box mb-2" @click="handleClick">
    <label class="radio">
      <span class="radio__input">
        <input type="radio" :name="questionId + '-' + answerId" :checked="isToggled" />
        <span class="radio__control"></span>
      </span>
      <span class="radio__label">{{text}}</span>
    </label>
  </div>
</template>

<script>
export default {
  name: "QuizAnswer",
  props: ['text', 'questionId', 'answerId'],
  data() {
    return {
      isToggled: false,
    }
  },
  methods: {
    handleClick() {
      window.$nuxt.$emit('questionSelected', {
        questionId: this.questionId,
        answerId: this.answerId,
      });
    }
  },
  mounted() {
    window.$nuxt.$on('questionSelected', (e) => {
      if (e.questionId === this.questionId && e.answerId === this.answerId) {
        this.isToggled = true;
      } else if(e.questionId === this.questionId) {
        this.isToggled = false;
      }
    })
  },
}
</script>

<style>
*,
*:before,
*:after {
  box-sizing: border-box;
}
.radio__label {
  color: #bdbec5;
}
.radio__input {
  display: flex;
}
.radio__input input {
  opacity: 0;
  width: 0;
  height: 0;
}
.is-active {
  background-color: #1a242c !important;
}
input:checked ~ .radio__control::before {
  content: "";
  width: 12px;
  height: 12px;
  box-shadow: inset 0.5em 0.5em currentColor;
  border-radius: 50%;
  transition: 180ms transform ease-in-out;
  transform: scale(1);
  color: #bdbec5;
}

.radio__control {
  display: grid;
  place-items: center;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: 0.1em solid #757a7d;;
}
.radio {
  color: #1a191e;
  display: grid;
  grid-template-columns: min-content auto;
  grid-gap: 0.5em;
}

.answer-box {
  padding: 5px 0 5px 1.25rem;
}
.answer-box:hover {
  background-color: #2f2f2f;

}
</style>