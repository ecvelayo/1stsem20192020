import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import jQuery from 'jquery'
import*as VueGoogleMaps from 'vue2-google-maps'
import firebase from 'firebase/app'
import 'firebase/firestore'
import 'firebase/auth'
window.jQuery=jQuery;require('semantic-ui-css/semantic.css')
require('semantic-ui-css/semantic.js')
Vue.use(VueGoogleMaps,{load:{key:'AIzaSyACCsXgfgkueRlwYezRrlaAZBe2hV-hr1c',libraries:'places',}});firebase.initializeApp({apiKey:'AIzaSyAhJjt15mqS0p7a1a77TF8zDm6EHjVuoYQ',authDomain:'firebase-adminsdk-v2kv5@beep-db-d2d2b.iam.gserviceaccount.com',projectId:'beep-db-d2d2b',databaseURL:"https://beep-db-d2d2b.firebaseio.com",});Vue.prototype.$db=firebase.firestore()
Vue.config.productionTip=!1
new Vue({router,store,render:h=>h(App)}).$mount('#app')