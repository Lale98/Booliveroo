<template>
  <div>
    <Header />
    <div class="jumbotron d-flex flex-column justify-content-center align-item-center">
      
      <div class="mb-3 logo text-center" >
        <img id="jumbo-logo" src="/img/jumbo-logo.png" alt="logo">
      </div>

      <div id="cate">
        <a id="pizza" href="#categorie" @click="selectCategory('Pizza')">
          <img id="pizza-categoria" src="../../../public/img/pizza-categoria.png" alt="pizza">
          <h5>Pizza</h5>
        </a>
        <a id="burger" href="#categorie" @click="selectCategory('Fast-Food')">
          <img src="../../../public/img/burger-categoria.png" alt="hamburger">
          <h5>Burger</h5>
        </a>
        <a id="sushi" href="#categorie" @click="selectCategory('Sushi')">
          <img src="../../../public/img/sushi-categoria.png" alt="sushi">
          <h5>Sushi</h5>
        </a>
      </div>

      <div>
        <a href='#categorie' class="categorie">
          <h3>Tutte le Categorie</h3>
        </a>
      </div>
      
      <div id="scroll">
        <h4>SCROLL DOWN</h4>
        <i class="fas fa-chevron-down"></i>
      </div>

    </div>
        
    <div class="curvy"></div>
    <div class="back-white">
      <div class="container main-page">
        <div class="text-center">
          <img src="/img/i-nostri-preferiti.png" alt="logo">
        </div>
        <div class="row justify-content-center">
            <Card 
            :item="restaurant"
            v-for="restaurant in restaurants" :key="restaurant.id"/>
        </div>

        <div id="categorie" class="text-center mb-5">
          <img src="/img/scegli-per-categoria.png" alt="logo">
        </div>

        <div class="badge-container">
          <div 
          class="badge-category" 
          v-for="category, index in categories" 
          :key="index" 
          @click="selectCategory(category.name)"
          >
            {{ category.name }}
          </div>
        </div>

        <div class="d-flex" id="choice">
            <div 
            v-for="item, index in ristoranti_categorie"
            :key="index"

            >
              <!-- {{ item.name }}
              {{ item.categories.name }} -->
              <span 
              v-for="category,index in item.categories" 
              :key="index"
              >
                <!-- {{ category.name }} -->
                <div v-show="categoriaScelta == category.name">
                    <!-- {{ item.name }} -->
                  <router-link :to="{ name: 'restaurant', params: { slug: item.slug } }">
                      <div class="card">
                        <img :src="'storage/'+ item.cover" alt="item.name" class="img">
                        <div class="container_name">
                          <h4 class="card-title">{{ item.name }}</h4>
                        </div>
                      </div>
                  </router-link>  
                </div>
              </span>
            </div>
        </div>
        


      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import Card from '../components/Card.vue';
import Footer from '../components/Footer.vue';
import Header from '../components/Header.vue';

export default {
    name: 'Home',
    beforeMount() {
    window.addEventListener('scroll', function(){
        var scroll = this.document.getElementById('scroll');
        scroll.classList.toggle('sticky', this.window.scrollY > 0)})
    },
    components:{
      Card,
      Footer,
      Header
    },
    data(){
      return{
        restaurants: [],
        categories: [],
        categoriaScelta: '',
        ristoranti_categorie: [],
      }
    },
    methods: {
        selectCategory(index){
          // console.log(index);
          this.categoriaScelta = index;
          console.log(this.categoriaScelta);
      },
      getRestaurants: function(){
        axios.
        get('http://127.0.0.1:8000/api/restaurants')
        .then((res)=>{
          // console.log(res.data.prova);
          this.ristoranti_categorie = res.data.prova;
          console.log(this.ristoranti_categorie);
          this.restaurants = res.data.restaurants.data;
        })
        .catch((err)=>{
           console.log(err);
        });
      },
      getCategory: function(){
          axios.
          get('http://127.0.0.1:8000/api/categories')
          .then((res)=>{
            // console.log(res.data);
            this.categories = res.data;
          })
          .catch((err)=>{
            console.log(err);
          });
        }
      },
      created: function(){
        this.getRestaurants();
        this.getCategory();
      }
}
</script>

<style lang="scss" scoped>

#cate a{
  position: relative;
  color: white;
}

#pizza h5 {
  position:absolute;
  top: 57px;
  left: 41px;
}
#burger h5 {
  position:absolute;
  top: 57px;
  left: 82px;
}
#sushi h5 {
  position:absolute;
  top: 57px;
  left: 53px;
}

#pizza-categoria {
  width: 130px;
}

.logo {
  img {
    width: 70%;
    height: 150px;
  }
}

.badge-container {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  width: 100%;
  //overflow-x: scroll;

  .badge-category {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    width: 100px;
    height: 50px;
    padding: 0 30px;
    border-radius: 10px;
    background-color: #ee3c4a;
    font-size: 18px;
    color: white;
    cursor: pointer;
    margin: 8px;
    // padding: 20px 10px;
  }
  
}

.categorie {
  color: #f5f5f5;
  text-transform: uppercase;
}

#categorie {
  margin-top: 100px;
}
.main-page {
  padding-bottom: 150px;
  height: auto;
}

.curvy {
  background-image: url('~/img/main-wave.png');
  height: 100px;
  width: 100%;
  background-repeat: no-repeat;
  background-size: cover;
}

.back-white {
  background-color: white;
}

.jumbotron {
  padding: 0;
  margin: 0;
  position: relative;
  width: 100%;
  height: 100vh;
  //background: url('~/img/jumbotron-gradientred.jpg') no-repeat;
  //background-attachment: fixed;
  background-color: transparent;
  background-size: cover;
  display: flex;
  flex-direction: column-reverse;
  align-items: center;
}

#scroll {
  position: absolute;
  bottom: 0%;
  left: 50%;
  transform: translateX(-50%);
  // margin-top: 260px;
  opacity: 1;
  transition: 0.8s;
  display: flex;
  flex-direction: column;
  align-items: center;
  color: white;
  i {
    font-size: 60px;
  }
}

#scroll.sticky {
  opacity: 0;
}

// .search-bar {
//   position: relative;
//   background:white;
// 	padding: 1rem;
// 	box-shadow: 0 0 30px 2px linear-gradient(90deg, #ee3c4a, #fc8237); 
// 	border-radius: 50px;
// 	width: 35%;
//   margin-bottom: 30px;
//   i {
//     position: absolute;
//     top: 50%;
//     right: 3%;
//     transform: translateY(-50%);
//     color : #fc8237;
//     font-size: 25px;
//   }
// }
.sushi {
  margin-top: 25px;
}
.category-selection {
  width: 30%;
  a {
    width: 100px;
    height: 100px;
  }
  img {
    width: 100%;
    //height: 100%;
    object-fit: cover;
    object-position: center;
  }
}
.search-input {
  width: 90%;
  border: none;
  font-size: 18px;
}
.search-input:focus {
  border: none;
  outline: none;
}


.card{
    .img {
        transition: all 0.8s ease-in-out;
        position: absolute;
        height: 100%;
        width: 100%;
    }
}

.card {
    position: relative;
    height: 200px;
    width: 300px;
    object-fit: cover;
    border-radius: 5%;
    margin-top: 30px;
    margin-right: 30px;
    margin-left: 30px;
    overflow: hidden;
    &:hover{
        cursor: pointer;
        .img {
            transform: scale(1.1);
        }
    }

    .container_name {
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        /* width: 100%;
        height: 100%; */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

        h4 {
            /* opacity: 15%; */
            color: white;
            font-weight: 900;
            font-size: 22px;
            line-height: 22px;
            margin: 0;
            padding: 5px;
        }
    }
}

@media screen and (max-width: 700px) {
  .badge-category {
    margin: 4px !important;
  }
  #jumbo-logo {
    height: 80px;
  }

  #cate {
    display: none;
  }

  #scroll {
    color: black;
    h4 {
      font-weight: 700;
    }
  }
  #choice {
    flex-direction: column;
  }
}



</style>