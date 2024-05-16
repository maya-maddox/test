require('./bootstrap');

// app.js
import { createApp } from 'vue';

if (document.getElementById('returnslog')) {
  const returnsLogApp = createApp()
  returnsLogApp.component('return-template', require('./Tools/ServiceCenter/ReturnsLog/Return.vue').default)
  returnsLogApp.mount("#returnslog");
}