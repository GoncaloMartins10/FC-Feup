function click_modalEncomendaAdmin(clicked_id,clicked_client) {
    $.ajax({
            url: '../../actions/modal_encomenda_admin.php',
            type: 'POST',
            data: {"id":clicked_id, "cliente":clicked_client},
            success: function(result) { 
                $("#div1").html(result);
                console.log(result);
            }
    });
}

function click_modalEncomenda(clicked_id) {
    $.ajax({
            url: '../../actions/modal_encomenda.php',
            type: 'POST',
            data: {"id":clicked_id},
            success: function(result) { 
                $("#div1").html(result);
                console.log(result);
            }
    }); 
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