<template>
  <div>
    <nuxt />
  </div>
</template>

<style>
html {
  font-family:
    'Source Sans Pro',
    -apple-system,
    BlinkMacSystemFont,
    'Segoe UI',
    Roboto,
    'Helvetica Neue',
    Arial,
    sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}

.button--green {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #3b8070;
  color: #3b8070;
  text-decoration: none;
  padding: 10px 30px;
}

.button--green:hover {
  color: #fff;
  background-color: #3b8070;
}

.button--grey {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #35495e;
  color: #35495e;
  text-decoration: none;
  padding: 10px 30px;
  margin-left: 15px;
}

.button--grey:hover {
  color: #fff;
  background-color: #35495e;
}
.d2l-button {
  background-color: #4bb1fa;
  color: #191919;
  border-radius: .3rem;
  border-style: none;
  border-width: 1px;
  box-sizing: border-box;
  cursor: pointer;
  display: inline-block;
  margin: 0 15px 15px 0;
  min-height: calc(20px + 2px);
  outline: none;
  text-align: center;
  transition: box-shadow .2s;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  vertical-align: middle;
  white-space: nowrap;
  width: auto;
  box-shadow: 0 0 0 4px transparent;
  font-family: inherit;
  padding: 11px 30px;
  font-weight: 900;
  font-size: 14px;
  letter-spacing: 0px;

}
.d2l-button:hover {
  background-color: #86c5ff;
}
.d2l-regular-button {
  background-color: #262b32;
  color: #959b9d;
  border-radius: .3rem;
  border-style: none;
  border-width: 1px;
  box-sizing: border-box;
  cursor: pointer;
  display: inline-block;
  margin: 0 15px 15px 0;
  min-height: calc(20px + 2px);
  outline: none;
  text-align: center;
  transition: box-shadow .2s;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  vertical-align: middle;
  white-space: nowrap;
  width: auto;
  box-shadow: 0 0 0 4px transparent;
  font-family: inherit;
  padding: 11px 30px;
  font-weight: 900;
  font-size: 14px;
  letter-spacing: 0px;

}
.d2l-regular-button:hover {
  background-color: #414c56;
}
</style>
