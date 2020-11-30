import moment from 'moment'
import Vue from 'vue'

Vue.filter('upperText', function (text){
    return text.toUpperCase();
})

Vue.filter('myDate', function (date){
    return moment(date).format('ll');
})

Vue.filter('myFullDate', function (date){
    return moment(date).format('LL');
})

Vue.filter('sortlength', (text, length,suffix) => {
    return text.substring(0,length)+suffix;
  })