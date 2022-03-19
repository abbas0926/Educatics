require('./bootstrap');

import {createApp} from 'vue';

import InvoicePage from './Pages/InvoicePage.vue';
import InvoiceItem from './Components/InvoiceItem.vue';

const app = createApp({});
app.component('invoice-page', InvoicePage);
app.component('invoice-item', InvoiceItem);
app.mount("#app");



// import Vue from 'vue';
// //import a component 
// // Vue.component('invoice-page', require('./Pages/InvoicePage.vue').default);
// // Vue.component('invoice-item-row', require('./Components/InvoiceItemRow.vue').default);


// const app =  new Vue({
//     el:'#app'
// });

// // const app = Vue.createApp({

// // });
// app.component('invoice-page',require('./Pages/InvoicePage.vue').default);
// app.moun("#app");
