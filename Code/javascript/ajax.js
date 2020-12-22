function click_modalEncomenda(clicked_id,clicked_client) {
    $.ajax({
            url: '../../actions/modal_encomenda.php',
            type: 'POST',
            data: {"id":clicked_id, "cliente":clicked_client},
            success: function(result) { 
                $("#div1").html(result);
                console.log(result);
            }
    }); 
}

function click_modalEditProduto(clicked_id) {
    var img = document.getElementById(clicked_id);

    $.ajax({
            url: '../../actions/modal_loja.php',
            type: 'POST',
            data: {"id":clicked_id},
            datatype: "json",
            success: function(result) { 
                var data = JSON.parse(result);
                document.getElementById("nome").value = data.nome;
                document.getElementById("descricao").value = data.descricao;
                document.getElementById("preco").value = data.preco;
                document.getElementById("stock").value = data.stock;

                document.forms['modal_lojaadmin']['id'].value = clicked_id;
                document.forms['modal_lojaadmin']['id'].type = "hidden";
            }
    });
    setTimeout(function() {
        document.getElementById("id01").style.display = "block";
    }, 300); 
}

function click_modalLoja(clicked_id) {

    var img = document.getElementById(clicked_id);
    var modalImg = document.getElementById("img01");

    $.ajax({
            url: '../../actions/modal_loja.php',
            type: 'POST',
            data: {"id":clicked_id},
            datatype: "json",
            success: function(result) { 
                var data = JSON.parse(result);
                document.getElementById("titulo").innerHTML = data.nome;
                document.getElementById("descricao").innerHTML = data.descricao;
                document.getElementById("preco").innerHTML = data.preco+"€";
                
                document.forms['modal_loja']['id'].value = clicked_id;
                document.forms['modal_loja']['id'].type = "hidden";

                document.forms['modal_loja']['quantidade'].max = data.stock;
                document.forms['modal_loja']['quantidade'].value = 1;
            }
    });
    setTimeout(function() {
        document.getElementById("id01").style.display = "block";
        modalImg.src = img.src;   
    }, 100); 
}

function click_modalMembro(clicked_id) {

    var img = document.getElementById(clicked_id);
    var modalImg = document.getElementById("img01");

    $.ajax({
            url: '../../actions/modal_membrosocio.php',
            type: 'POST',
            data: {"id":clicked_id},
            datatype: "json",
            success: function(result) { 
                var data = JSON.parse(result);
                document.getElementById("nome").innerHTML = data.nome;
                document.getElementById("morada").innerHTML = data.morada;
                document.getElementById("telefone").innerHTML = data.telefone;
                document.getElementById("num_socio").innerHTML = data.num_socio;
            }
    });
    setTimeout(function() {
        document.getElementById("id01").style.display = "block";
        modalImg.src = img.src;   
    }, 100); 
}

function click_modalEditDados(clicked_id) {
    var img = document.getElementById(clicked_id);

    setTimeout(function() {
        document.getElementById("id01").style.display = "block";
    }, 100); 
}

function click_acceptSocio(socio) {
    if (confirm("Tem a certeza que quer aceitar o sócio")) {
            $.ajax({
                url: '../../actions/accept_socio.php',
                type: 'POST',
                data: {"id":socio},
                success: function(response) { window.location.reload(); }
            });
    }
} 

function click_eliminateSocio(socio) {
    if (confirm("Tem a certeza que quer eliminar o sócio")) {
            $.ajax({
                url: '../../actions/remove_socio.php',
                type: 'POST',
                data: {"id":socio},
                success: function(response) { window.location.reload(); }
            });
    }
}   

function click_eliminateJogador(jogador) {
    if (confirm("Tem a certeza que quer eliminar o jogador")) {
            $.ajax({
                url: '../../actions/remove_jogador.php',
                type: 'POST',
                data: {"id":jogador},
                success: function(response) { window.location.reload(); }
            });
    }
}  

function click_eliminateProduto(id) {
    if (confirm("Tem a certeza que quer apagar o produto")) {
            $.ajax({
                url: '../../actions/remove_produto.php',
                type: 'POST',
                data: {"id":id},
                success: function(response) { 
                    window.location.reload(); }
            });
    }
}

function click_eliminateLinhaEncomenda(id) {
    if (confirm("Tem a certeza que quer apagar")) {
            $.ajax({
                url: '../../actions/remove_linhaencomenda.php',
                type: 'POST',
                data: {"id":id},
                success: function(response) { window.location.reload();}
            });
    }
}  