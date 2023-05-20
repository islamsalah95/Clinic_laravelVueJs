<template>
<div>
<overlay Title="All Doctors"></overlay>


<!-- portfolio -->
<section class="section doctors">
  <div class="container">
  	  <div class="row justify-content-center">
             <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Doctors</h2>
                    <div class="divider mx-auto my-4"></div>
                    <p>We provide a wide range of creative services adipisicing elit. Autem maxime rem modi eaque, voluptate. Beatae officiis neque </p>
                </div>
            </div>
        </div>

      <div class="col-12 text-center  mb-5">
	        <div class="btn-group btn-group-toggle " data-toggle="buttons">
	         
              <label v-for="department in departments" :key="department.id" class="btn " @click="departmentId(department.id)">
	            <input type="radio" name="shuffle-filter" value="cat1" />{{department.department}}
	          </label>

	        </div>
      </div>

    <div class="row shuffle-wrapper portfolio-gallery">
      
        <div v-for="doctor in doctors" :key="doctor.id" class="col-lg-3 col-sm-6 col-md-6 mb-4 shuffle-item" data-groups="[&quot;cat1&quot;,&quot;cat2&quot;]">
	      	<div class="position-relative doctor-inner-box">
		        <div class="doctor-profile">
	               <div class="doctor-img">
	               		<img src="http://127.0.0.1:8000/theme/images/team/1.jpg" alt="doctor-image" class="img-fluid w-100">
	               </div>
	            </div>
                <div class="content mt-3">
                	<h4 class="mb-0"><a href="doctor-single.html">{{doctor.name}}</a></h4>
                	<p>Cardiology</p>
                </div> 
	      	</div>
      	</div>



    </div>
  </div>
</section>
<!-- /portfolio -->
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
      departments: [],
      doctors: [],

  };
  },
  methods: {
    departmentId(departmentId){
         this.displayDoctors(departmentId);
    },


    displayDoctors(DepartmentId){
        axios.get(`http://127.0.0.1:8000/api/DepartmentDoctors/${DepartmentId}`)
      .then((res) => {console.log(res.data.data);
       this.doctors=res.data.data;
       })
      .catch((error) => {console.log(error);});
    }
  }
,created() {
      axios.get(`http://127.0.0.1:8000/api/showDepartment`)
      .then((res) => {console.log(res.data.data);
       this.departments=res.data.data;
       })
      .catch((error) => {console.log(error);});
      this.displayDoctors(1);
},computed:{


}

};
</script>