import Vue from 'vue';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

new Vue({
	el: '#mainDiv',
	data:{
		allData: [],
	},
	mounted(){
		axios.get('/promotion/getPromotionsData').then(response => this.allData = response.data);
	},
	methods:{
		
	}
});