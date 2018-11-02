(function(){
    $(document).ready(function(){
        let products = '';
        //tags
        $('.btnSign').on('click',function(){
            $(this).attr('class','btn btn-success btnSign');
            $(this).siblings().attr('class','btn btn-default btnSign');
            $('#boxSignIn').show();
            if($(this).text().toUpperCase() == 'CLIENT'){
                $('#btnSignUp').show();
                $('input[type=hidden]').val('client');
            }
            else{
                $('#btnSignUp').hide();
                $('#boxSignUp').hide();
                $('input[type=hidden]').val('admin');
            }
        });

        //show form to add a new product
        $('#add').on('click',function(){
          $('#boxInsert h2').text('Ajouter un produit');
          $('#boxInsert input[type=submit]').val('Ajouter');
          $('td.update>button').attr('disabled',true);
          $('#boxInsert').show();
        });

        //show/hide sign in/sign up form
        $('#btnSignUp').on('click',function(){
            $('#boxSignUp').show();
            $('#boxSignIn').hide();
        });

        showProducts(products,'#productList tbody');
        /**
        *@desc show a message then remove it
        @param id String html element contains the userMessage
        @param msg String the content
        @param classBstrp String bootstrap class
        @param delay int the duration
        */
        function userMessage(id,msg,classBstrp,delay){
          $(id).addClass(classBstrp).text(msg);
          setTimeout(function(){
            $(id).removeClass(classBstrp).empty();
          },delay);
        }

        /**
         * @desc get products info
         * @param {Array} products data
         * @param {String} tableBody tbody element
         */
        function showProducts(products,tableBody){
            $(tableBody).parent().empty();
            var table = `
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>En stock</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        `;
            $('#productList').append(table);
            $.ajax({
                type:'get',
                url:'../bdd/listeProduit.php',
                success:function(data){
                    products = JSON.parse(data);
                    $.each(products,function(i,product){
                        var td = `<tr id="${product.id_produit}">
                                    <td>${product.nom_produit}</td>
                                    <td>${product.description_produit}</td>
                                    <td>${product.prix_produit}</td>
                                    <td>${product.quantite_produit}</td>
                                    <td class="delete">
                                      <button class="btn btn-danger">
                                        <span class="glyphicon glyphicon-remove"></span>
                                      </button>
                                    </td>
                                    <td class="update">
                                      <button class="btn btn-warning">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                      </button>
                                    </td>
                                </tr>`;
                        $(tableBody).append(td);
                    });
                },
                error : function(){
                    $('#productList').text('Erreur au niveau de l\'execution de la connexion côté serveur');
                }
            });
        }

        //Get products for customer


        //request from client to php server in order to sign in or sign up or update product
        $('form').on('submit',function(e){
            e.preventDefault();
            var action = $(this).data('url');
            $.ajax({
                type:'post',
                url:action,
                data:$(this).serialize(),
                success:function(data){
                    console.log('data',data);
                    switch (data) {
                      case 'admin':
                        window.location.replace('admin/gestion.php');
                      break;
                      case 'client':
                        window.location.replace('client/accueil.php');
                      break;
                      case 'inscription':
                        $('#userMsg').text('Votre compte a été crée, veuillez vous connecter.');
                        $('#btnSignUp').hide();
                        $('#boxSignUp').hide();
                        $('.btnSign:first-of-type').trigger('click');
                      break;
                      case 'ajout':
                        userMessage('#userMsg','Le produit a été ajouté!','alert alert-success',5000);
                        $('td.update>button').attr('disabled',false);
                        showProducts(products, '#productList tbody');
                      break;
                      case 'modifier':
                        userMessage('#userMsg','Le produit a été mis à jour!','alert alert-success text-success',5000);
                        $('#boxInsert').hide();
                        $('#add').attr('disabled',false);
                        showProducts(products, '#productList tbody');
                      break;
                      default:
                        $('#userMsg').text(data);
                      break;
                    }
                    //reset form inputs && textarea
                    $('form')[0].reset();
                    $('form textarea').empty();
                },
                error : function(){
                    console.log('erreur');
                    $('#userMsg').text('Erreur au niveau de l\'execution de la connexion côté serveur');
                }
            });
        });

        //delete product
        $('body').on('click','td.delete',function(){
            console.log($(this).parent().attr('id'));
            $.ajax({
                type:'post',
                data:
                {
                    id : $(this).parent().attr('id')
                },
                url:'../admin/supprimer.php',
                success:function(data){
                    showProducts(products, '#productList tbody');

                },
                error : function(){
                    $('#productList').append('<p class="text-danger">Erreur au niveau de l\'execution de la connexion côté serveur</p>');
                }
            });
        });

        //update product
        $('body').on('click','td.update',function(){
            $('#add').attr('disabled',true);
            $('#boxInsert form').attr('data-url','../admin/modifier.php');
            $('#boxInsert h2').text('Modififier le produit');
            $('#boxInsert input[type=submit]').val('Modifier');

            var tr = $(this).parent();
            $('td.update').each(function(){
              $(this).parent().removeClass('text-warning');
            });

            tr.attr('class','text-warning');

            var idI = $('#boxInsert input[type=hidden]').val(tr.attr('id'));
            var nameI = $('#boxInsert input[name="name"]').val(tr[0].children[0].innerText);
            var descriptionI = $('#boxInsert textarea[name="description"]').text(tr[0].children[1].innerText);
            var priceI = $('#boxInsert input[name="price"]').val(tr[0].children[2].innerText);
            var qtiteI = $('#boxInsert input[name="quantite"]').val(tr[0].children[3].innerText);
            $('#boxInsert').show();
        });

        //get products for customer
        $.ajax({
            type:'get',
            url:'../bdd/listeProduit.php',
            success:function(data){
                products = JSON.parse(data);
                $.each(products,function(i,product){
                    var td = `
                                <div class="thumbnail col-3">
                                  <img src="../img/${product.photo}" alt="photo du produit">
                                  <div class="caption">
                                    <h3>${product.nom_produit}</h3>
                                    <p class="d-none">${product.id_produit}</p>
                                    <p>${product.description_produit}</p>
                                    <p>${product.prix_produit}&nbsp;<span class="glyphicon glyphicon-euro"></span></p>
                                    <p>
                                      <span>En stock ${product.quantite_produit}<span>
                                      <span class="glyphicon glyphicon-eye-open"></span>
                                    </p>
                                    <button class="cart btn btn-success">
                                      <span class="glyphicon glyphicon-shopping-cart"></span>
                                    </button>
                                  </div>
                                </div>`;
                    $("#market").append(td);
                });
            },
            error : function(){
                $('#market').text('Erreur au niveau de l\'execution de la connexion côté serveur');
            }
        });

    });
})();
