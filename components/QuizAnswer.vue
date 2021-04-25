<template>
  <div :class="{ 'is-active': isToggled }" class="form-check answer-box mb-2" @click="handleClick">
    <label class="radio">
      <span class="radio__input">
        <input type="radio" :name="questionId" />
        <span class="radio__control"></span>
      </span>
      <span class="radio__label">{{text}}</span>
    </label>
  </div>
</template>

<script>
export default {
  name: "QuizAnswer",
  props: ['text', 'questionId'],
  data() {
    return {
      isToggled: false,
    }
  },
  methods: {
    handleClick() {
      window.$nuxt.$emit('questionSelected', {
        questionId: this.questionId,
        questionText: this.text,
      });
    }
  },
  mounted() {
    window.$nuxt.$on('questionSelected', (e) => {
      if (e.questionId === this.questionId && e.questionText === this.text) {
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
.radio__input input:checked ~ .radio__control {
  /*background: radial-gradient(currentcolor 50%, rgba(255, 0, 0, 0) 51%);*/
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
input:focus ~ .radio__control {
  /*box-shadow: 0 0 0 0.05em #fff, 0 0 0.15em 0.1em currentColor;*/
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

.d2l-radio {
  appearance: none;
  background-position: 50%;
  background-repeat: no-repeat;
  background-size: .5rem .5rem;
  background-color: #1a1b1f;
  border-color: #757a7d;
  border-radius: 56%;
  border-style: solid;
  border-width: 1px;
  box-sizing: border-box;
  display: inline-block;
  height: 24px;
  margin: 0;
  padding: 0;
  vertical-align: middle;
  width: 24px;

}
.d2l-radio:hover {
  border-color: #006fbf;
  border-width: 2px;
}

.d2l-text {
  margin-left: 32px;
  padding-bottom: 0;
  margin-bottom: 0;
}
</style>