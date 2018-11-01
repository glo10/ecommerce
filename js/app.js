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
            $('#boxInsert').show();
        });

        //show/hide sign in/sign up form
        $('#btnSignUp').on('click',function(){
            $('#boxSignUp').show();
            $('#boxSignIn').hide();
        });

        showProducts(products,'#productList tbody');
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
                url:'../admin/listeProduit.php',
                success:function(data){
                    products = JSON.parse(data);
                    $.each(products,function(i,product){
                        var td = `<tr class="link" id="${product.id_produit}">
                                    <td>${product.nom_produit}</td>
                                    <td>${product.description_produit}</td>
                                    <td>${product.prix_produit}</td>
                                    <td>${product.quantite_produit}</td>
                                    <td class="delete"><span class="glyphicon glyphicon-remove text-danger"></span></td>
                                    <td class="update"><span class="glyphicon glyphicon-pencil text-warning"></span></td>
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


        //request from client to php server in order to sign in or sign up
        $('form').on('submit',function(e){
            e.preventDefault();
            var action = $(this).data('url');
            console.log('action',action);
            $.ajax({
                type:'post',
                url:action,
                data:$(this).serialize(),
                success:function(data){
                    console.log('data',data);
                    if(data == 'admin'){
                      window.location.replace('admin/gestion.php');
                    }
                    else if(data == 'client'){
                        window.location.replace('client/accueil.php');
                    }
                    else if(data == 'inscription'){
                        $('#userMsg').text('Votre compte a été crée, veuillez vous connecter.');
                        $('#btnSignUp').hide();
                        $('#boxSignUp').hide();
                        $('.btnSign:first-of-type').trigger('click');
                    }
                    else if(data == 'ajout'){
                        var tbody = '#productList tbody';
                        showProducts(products, tbody);
                    }
                    else{
                        console.log('sucess mais ni ajout ni connexion');
                        $('#userMsg').text(data);
                    }
                },
                error : function(){
                    console.log('erreur');
                    $('#userMsg').text('Erreur au niveau de l\'execution de la connexion côté serveur');
                }
            });
        });

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
                    console.log(data);
                    showProducts(products, '#productList tbody');

                },
                error : function(){
                    $('#productList').append('<p class="text-danger">Erreur au niveau de l\'execution de la connexion côté serveur</p>');
                }
            });
        });

        $('body').on('click','td.update',function(){
            console.log($(this).parent().attr('id'));
            var tr = $(this).parent();
            $('#boxInsert h3').text('Modififier le produit');
            $('#boxInsert input[type=submit]').val('Modifier');

            /*
            var nameI = $('#boxInsert input[name="name"]').val('');
            var priceI = $('#boxInsert input[name="price"]').val('');
            var qtiteI = $('#boxInsert input[name="quantite"]').val('');
            var descriptionI = $('#boxInsert input[name="description"]').val('');*/
            $('#boxInsert').show();
            $.ajax({
                type:'post',
                data:
                {
                    id : $(this).parent().attr('id'),
                    name : nameI,
                    price : priceI,
                    qtite : qtiteI,
                    description : descriptionI

                },
                url:'../admin/modifier.php',
                success:function(data){
                    console.log(data);
                    showProducts(products, '#productList tbody');

                },
                error : function(){
                    $('#productList').append('<p class="text-danger">Erreur au niveau de l\'execution de la connexion côté serveur</p>');
                }
            });
        });

    });
})();
