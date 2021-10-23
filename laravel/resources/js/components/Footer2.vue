<template>
    <div>
        <div class="curvy">
        </div>
        <div class="footer">
            <div class="container py-4">
                <div class="row">
                    <div class="col">
                        <div class="col_background">
                            <h3>Scoprici</h3>
                            <ul class="my-ul">
                                <li v-for="(link, index) in scopri" :key="index">
                                    <a href="#">{{link}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="col_background">
                            <h3>Note legali</h3>
                            <ul class="my-ul">
                            <li v-for="(link, index) in note" :key="index">
                                <a href="#">{{link}}</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="col_background">
                            <h3>Aiuto</h3>
                            <ul class="my-ul">
                            <li v-for="(link, index) in interesse" :key="index">
                                <a href="#">{{link}}</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="col_background">
                            <h3>Seguici</h3>
                            <ul class="my-ul">
                                <li>
                                    <a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
                                    <a href="#"><i class="fab fa-instagram-square fa-2x"></i></a>
                                    <a href="#"><i class="fab fa-twitter-square fa-2x"></i></a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Google_Play_Store_badge_IT.svg/1024px-Google_Play_Store_badge_IT.svg.png" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Footer',
    data: () => ({
      scopri : [
        'Chi siamo',
        'Ristoranti',
        'Altro',
        'Il nostro blog',
        'Programmazione',
        'Design',
        'Lavora con noi',
        'Diventa nostro partner',
      ],
      note: [
        'Termini & Condizioni',
        'Informativa sulla privacy',
        'Cookies',
      ],
      interesse: [
        'Contatti',
        'FAQ',
        'Tipi di cucina',
        'Mappa del sito'
      ],
      seguici: [
          'Facebook',
          'Twitter',
          'Instagram'
      ]
    }),
}
</script>

<style lang="scss" scoped>

    .curvy {
        background-image: url('~/img/footer-wave1.png');
        height: 100px;
        width: 100%;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .footer {
        background-color: #1D1D1D;
        color: white;
    }

    .col_background{
      padding: 30px 5px;
      /* background-color: rgba(255,255,255, 0.1); */
      width: calc(100% / 4 - 15px);
      border-radius: 3px;
      margin: 10px;
      min-width: 224px;
        &:first-child{
            margin-left: 0px;
        }
        &:last-child{
            margin-right: 0px;
        }

        h3 {
            font-style: italic;
            text-transform: uppercase;
            color: #ee3c4a;
        }

        a {
            color: #f5f5f5;
        }
    }


    img {
        width: 60%;
    }

    ul{
        list-style: none;
        padding-left: 0;
    }
</style>