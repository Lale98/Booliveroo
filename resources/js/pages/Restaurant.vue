<template>
<div>
  <Header />
  <div class="sfondo">
      <div class="wrapper container-fluid">
        <div class="row main-page">
          <div class="my-4 text-center col-xl-6 offset-xl-1 col-lg-8 offset-lg-2">
            <h2>{{ restaurant.name }}</h2>
            <p>{{ restaurant.description }}</p>
            <div class="d-flex flex-wrap justify-content-between card-container">
              <div 
              v-for="plate in restaurant.plates" 
              :key="plate.id"
              class="card mb-3 "
              >
                <div class="title-container">
                  <h3>{{ plate.name }}  <i class="fas fa-leaf foglia" v-if="plate.veg == 1"></i></h3>
                </div>
                
                <img :src="'/storage/' +  plate.img" :alt="plate.name">

                <div class="font-weight-bold">{{ plate.price.toFixed(2) }} €</div>

                <button class="btn btn-sm" @click="controlla(plate)">Aggiungi al carrello</button>

              </div>
            </div>
          </div>

          <div class="cart col-xl-4 offset-xl-1 col-lg-8 offset-lg-2 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <h3>Il tuo carello</h3>
              <button class="btn btn-gradient">
                {{ badge }}
              </button>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>Piatto</th>
                  <th>Prezzo</th>

                  <th>Quantità</th>
                  <th>Elimina</th>

                </tr>
              </thead>
              <tbody>
                    <tr v-for="(cart, n) in carts" :key="cart.id">
                      <td>{{ cart.name }}</td>

                      <td>{{ cart.price.toFixed(2) }} €</td>

                      <td class="d-flex justify-content-around align-items-center">
                        <button class="btn btn-quantita btn-sm" @click="removeQuantity(cart, n)">-</button>
                        <span class="num">{{ cart.quantity }}</span>
                        <button class="btn btn-quantita btn-sm" @click="upQuantity(cart, n)">+</button>
                      </td>
                        
                      <td>
                        <i @click="removeCart(n)" class="fas fa-times"></i>
                      </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">

                <h4>Totale Prezzo: {{ totalPrice.toFixed(2) }} €</h4>
                <a href="http://127.0.0.1:8000/form-cliente" class="paga">
                  <button class="btn btn-gradient btn-sm">Paga</button>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
</div>

</template>

<script>
import swal from 'sweetalert';
import Button from '../components/Button-Counter';
import Footer from '../components/Footer';
import Header from '../components/Header2';

export default {
    name: 'Restaurant',
    components:{
        Button,
        Footer,
        Header
    },
    data(){
      return{
        restaurant: [],
        restaurantID: '',
        plate: {
          id: '',
          name: '',
          description: '',
          price: '',
          restaurant_id: '',
          quantity: 2
        },
        add: true,
        edit: false,
        carts: [],
        cartAdd: {
          id: '',
          name: '',
          description: '',
          price: '',
          restaurant_id: '',
          quantity: 1
        },
        badge: '0',
        quantity: 2,
        totalPrice: 0,
        esistente: false,
        r : '',

      }
    },
    methods: {
      vuoto() {
        this.carts = [];
        this.totalPrice = 0;
        this.storeCart();
      },
      viewCart(){
          if(localStorage.getItem('carts')){
            this.carts = JSON.parse(localStorage.getItem('carts'));
            this.badge = this.carts.length;
            this.totalPrice = this.carts.reduce((totalPrice, item)=>{
                //console.log(this.carts)
                //console.log(item);
                return totalPrice + item.quantity * item.price;
            }, 0)
          }
      },
      upQuantity(cart){
            //console.log(cart);
            //console.log(n);
            cart.quantity++;
            this.storeCart(); 
      },
      removeQuantity(cart){
            //console.log(cart);
            //console.log(n);
            if(cart.quantity > 1) {
              cart.quantity--;
            }else {
              this.removeCart(cart);
            }
            this.storeCart(); 
      },
      addCart(plate){
        // console.log(this.restaurant.id);
        // console.log(this.restaurant.plates[1].restaurant_id);
        if(this.carts.length == 0){
          this.cartAdd.id = plate.id;
          this.cartAdd.name = plate.name;
          this.cartAdd.price = plate.price;
          this.cartAdd.quantity = 1;
          this.cartAdd.restaurant_id = plate.restaurant_id;
          this.carts.push(this.cartAdd);
          this.storeCart();
        }else if (this.carts.length != 0 && this.restaurant.plates[0].restaurant_id == this.carts[0].restaurant_id){
              this.cartAdd.id = plate.id;
              this.cartAdd.name = plate.name;
              this.cartAdd.price = plate.price;
              this.cartAdd.quantity = 1;
              this.cartAdd.restaurant_id = plate.restaurant_id;
              this.carts.push(this.cartAdd);
              this.storeCart();
        } else {
          swal('error');
        }
        // else {
        //   var domanda = confirm('Se aggiungi un piatto da un diverso ristorante, si svuoterà il carrello!');
        //   if(domanda == true){
        //     this.carts = [];
        //     this.totalPrice = 0;
        //     this.cartAdd.id = plate.id;
        //     this.cartAdd.name = plate.name;
        //     this.cartAdd.price = plate.price;
        //     this.cartAdd.quantity = 1;
        //     this.cartAdd.restaurant_id = plate.restaurant_id;
        //     this.carts.push(this.cartAdd);
        //     this.storeCart();
        //   }else {
        //     alert('Torna al ristorante precedente');
        //     this.esistente = true;
        //   }
        // }
          
      },
      controlla(plate){
        this.carts.forEach(el=>{
          if(el.id == plate.id || el.restaurant_id != plate.restaurant_id){
            this.esistente = true;
            console.log(this.esistente);
          }
        });

        if(this.esistente == false){
          this.addCart(plate); 
          console.log('aggiunto'); 

          swal("Aggiunto Al Carrello!", plate.name, "success");

        }else {
          if (plate.restaurant_id != this.carts[0].restaurant_id) {

            swal({
              title: "Sei sicuro?",
              text: "Se aggiungi un piatto di un diverso ristorante, il carrello si svuoterà !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                this.carts = [];
                this.totalPrice = 0;
                this.cartAdd.id = plate.id;
                this.cartAdd.name = plate.name;
                this.cartAdd.price = plate.price;
                this.cartAdd.quantity = 1;
                this.cartAdd.restaurant_id = plate.restaurant_id;
                this.carts.push(this.cartAdd);
                this.storeCart();
                this.esistente = false;
                swal("Il tuo carrello e' stato svuotato", {
                  icon: "success",
                });
              } else {
                swal("Torna al ristorante precendente");
              }
            });

            // var domanda = confirm('Se aggiungi un piatto da un diverso ristorante, si svuoterà il carrello!');
            // if(domanda == true){
            //   this.carts = [];
            //   this.totalPrice = 0;
            //   this.cartAdd.id = plate.id;
            //   this.cartAdd.name = plate.name;
            //   this.cartAdd.price = plate.price;
            //   this.cartAdd.quantity = 1;
            //   this.cartAdd.restaurant_id = plate.restaurant_id;
            //   this.carts.push(this.cartAdd);
            //   this.storeCart();
            //   swal("Aggiunto Al Carrello!", plate.name, "success");
            // }else {
            //   alert('Torna al ristorante precedente');
            //   this.esistente = true;
            // }
          } else if (this.esistente == true) {
            swal('Cambia la quantità dal carrello', "", "error");
            this.esistente = false;
          }
        }
      },
      removeCart(plate){
        this.carts.splice(plate, 1);
        this.storeCart();
      },
      storeCart(){
          let parsed = JSON.stringify(this.carts);
          
          localStorage.setItem('carts', parsed);
          this.viewCart();
      },
      getRestaurant: function(slug){
        axios.
        get(`http://127.0.0.1:8000/api/restaurant/${slug}`)
        .then((res)=>{
          // console.log(res.data[0].plates);
          //this.plates = res.data[0].plates;
          this.restaurant = res.data[0];
          this.restaurantID = res.data[0].id;
          this.restaurant.plates.forEach(element => {
              element['quantity'] = 0;
          });
          //console.log(this.plates);
        })
        .catch((err)=>{
           console.log(err);
        });
      }
    },
    created: function(){
      this.getRestaurant(this.$route.params.slug);
      this.viewCart();
      //console.log(this.cart)
    },
    updated: function() {
      let total = JSON.stringify(this.totalPrice);
      localStorage.setItem('totalPrice', total);

      let restaurantID = JSON.stringify(this.restaurantID);
      localStorage.setItem('restaurantID', restaurantID);
    }
}
</script>

<style lang="scss" scoped>

h2 {
  margin: 50px 0;
  font-size: 46px;
  text-transform: uppercase;
  color: #ee3c4a;
}
h2+p {
  font-style: italic;
}
.num {
  margin: 0 5px;
}
.btn-quantita {
  border: none;
  background-color: white;
}
.sfondo {
  height: auto;
  background-color: white;
}
.fa-times{
  color: red;
  font-size: 23px;
  cursor: pointer;
  margin-left: 15px;
}

.wrapper {
  margin-top: 100px;
}

.card {
  display: flex;
  padding: 5px;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  width: calc(30%);
  height: 325px;
  border: 2px solid orangered;
  background-color: whitesmoke;
  border-radius: 15px;
  
  button {
    background: linear-gradient(90deg, #ee3c4a, #fc8237);
    border: none;
    color: white;
  }
}

.title-container {
  height: 70px;
}

img {
  width: 100%;
  height: 60%;
  object-fit: contain;
}

.cart {
  padding-right: 50px;
  margin-top: 100px;
}

.main_page {
  padding-bottom: 50px;
}

.foglia {
  color: green;
}

@media screen and (max-width: 1200px) {
  .main-page {
    display: flex;
    flex-direction: column-reverse;
  }
}
@media screen and (max-width: 650px) {
  .card {
    width: 45%;
  }
}
@media screen and (max-width: 415px) {
  .card {
    width: 80%;
  }

  .card-container {
    justify-content: center !important;
  }
}

</style>