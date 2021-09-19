<template>
  <div>
      <div>
          <router-view></router-view>
      </div>

  </div>
</template>

<script>




export default {
    name: 'App',
}
</script>

<style>

    body {
        background: url('~/img/jumbotron-gradientred.jpg') fixed no-repeat;
        background-size: cover;
    }
    html {   
        scroll-behavior: smooth;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #ee3c4a, #fc8237);
        color: white;
    }
</style>