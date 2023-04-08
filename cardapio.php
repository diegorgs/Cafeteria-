<html lang="pt-br">

<?php include('head.php') ?>

<body onload="categoria('1')">
  <?php include('nav.php') ?>
  <section class="py-7 py-md-9 border-bottom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 text-center">

          <!-- Heading -->
          <h2 class="mb-2">
            Opções do cardápio
          </h2>

          <!-- Subheading -->
          <p class="mb-6">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Ratione numquam eos perferendis itaque hic unde, ad, laudantium minima.
          </p>

        </div>
      </div>
      <div class="row">
        <div class="col">

          <!-- Navigation -->
          <div class="nav justify-content-center mb-6" id="menuTabs" role="tablist">
            <a class="nav-link catColor catHover" onclick="categoria('1')">
              Lanches
            </a>
            <a class="nav-link catColor catHover" onclick="categoria('2')">
              Almoços
            </a>
            <a class="nav-link catColor catHover" onclick="categoria('3')">
              Cafés
            </a>
            <a class="nav-link catColor catHover" onclick="categoria('4')">
              Bebidas
            </a>
            <a class="nav-link catColor catHover" onclick="categoria('5')">
              Sobremesa
            </a>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-12">

          <!-- Content -->
          <div class="tab-content" id="menuContent">
            <div class="tab-pane fade show active" id="mains" role="tabpanel" aria-labelledby="mainsTab">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="py-3 border-bottom">
                    <div id="catReceber">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>


  <!--MODAL-->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Carrinho</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4 id="cont">Lista de Produtos</h4>
          <p id="nome-card"></p>
          </h5>
        </div>
        <div class="modal-footer">
          <h4>Total:<p class="valor-total"></p>
          </h4>
          <a class="corHover" href="cardapio.php"><button type="button" class="btn btn-danger  p-2">Limpar </button></a>
          <button type="button" class="btn btn-warning p-2" data-bs-dismiss="modal">Adicionar +</button>
          <button type="button" onclick="Comprar()" class="btn btn-success p-2">Comprar</button>
        </div>
      </div>
    </div>
  </div>






  <!-- JAVASCRIPT -->
  <!-- Vendor JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/vendor.bundle.js"></script>
  <!-- Theme JS -->
  <script src="js/theme.bundle.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>




  <script>
    let cat = document.getElementById('catReceber');
    let tot = document.querySelector('.valor-total');
    let nomeSaida = document.getElementsByClassName('card-nome');
    let btn = document.getElementsByClassName('btn btn-primary');
    let carrinho = document.querySelector('p#cont');
    let nome = document.getElementById('nome-card');
    let valor = document.getElementsByClassName('card-valor');
    let receberPay = document.getElementById('payReceber')


    function categoria(id) {
      id = id;
      $.ajax({
        url: 'http://localhost/Cafeteria--main/model/cat.php',
        method: 'GET',
        data: {
          id: id,
        },
        dataType: 'json'
      }).done((dados) => {
        cat.innerHTML = '';
        for (let i = 0; i < dados.length; i++) {
          let valor = Number(dados[i].valor);
          let idProduto = dados[i].idProduto;
          $("#catReceber").append(`<div class="row">
                          <div class="col-3 align-self-center">

                            <!-- Image -->
                            <div class="ratio ratio-1x1">
                              <img class="object-fit-cover" src="imgProdutos/${dados[i].img}" alt="...">
                            </div>

                          </div>
                          <div class="col-7">
                            <!-- Heading -->
                            <h5 class="card-nome">${dados[i].nome}</h5>

                            <!-- Text -->
                            <p class="mb-0">
                            ${dados[i].descr}
                            </p>

                          </div>
                          <div class="col-2">

                            <!-- Price -->
                            <div class="fs-4 font-serif text-center text-black">
                              R$<h4 class="card-valor p-0 m-0">${valor.toFixed(2)}</h4>
                              
                              <div class="py-2">
                                <button type="button" key="${[i]}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                  Comprar
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>`);
        }

        total = Number(tot.innerHTML);
        listar(total, nomeSaida)

      })
    }

    function listar(total, nomeSaida) {

      for (var i = 0; i < btn.length; i++) {
        btn[i].addEventListener("click", function() {

          let key = this.getAttribute('key');
          total += Number(valor[key].innerHTML);
          tot.innerHTML = total.toFixed(2);
          //alert(nomeSaida[1].innerHTML) 
          nome.innerHTML += nomeSaida[key].innerHTML + ' R$' + Number(valor[key].innerHTML).toFixed(2) + '<br>';
        });
       
      }
      
    }
    function Comprar(total, nomeSainda){
   
    }
  </script>
</body>

</html>