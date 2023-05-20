<template>
    <div>
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">{{ Title }}</span>
          <h1 class="text-capitalize mb-5 text-lg">What We Do</h1>

          <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Our services</a></li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
</section>
    </div>
</template>
<script>
export default {
  props: ['Title'],

}
</script>