<template>
    <div>

<overlay Title="Our services"></overlay>

<section class="section service-2">
	<div class="container">
		<div class="row">
			
            <div v-for="result in results" :key="result.id" class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-block mb-5">
					<img src="http://127.0.0.1:8000/theme/images/service/service-1.jpg" alt="" class="img-fluid">
					<div class="content">
						<h4 class="mt-4 mb-2 title-color">{{result.service}}</h4>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>


<section class="section cta-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="cta-content">
					<div class="divider mb-4"></div>
					<h2 class="mb-5 text-lg">We are pleased to offer you the <span class="title-color">chance to have the healthy</span></h2>
					<a href="appoinment.html" class="btn btn-main-2 btn-round-full">Get appoinment<i class="icofont-simple-right  ml-2"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
    </div>
</template>

<script>
import overlay  from '../overlay.vue'
export default {
    components:{
        overlay
  },

  data() {
  return {
      results: [],
  };
  },
  methods: {}
,created() {
      axios.get(`http://127.0.0.1:8000/api/showServices`)
      .then((res) => {console.log(res.data.data);
       this.results=res.data.data;
       })
      .catch((error) => {console.log(error);});
},

};
</script>