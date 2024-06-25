function atualizaRelogio() { 
    var momentoAtual = new Date();
    
    var vhora = momentoAtual.getHours();
    var vminuto = momentoAtual.getMinutes();
    var vsegundo = momentoAtual.getSeconds();
    
    var vdia = momentoAtual.getDate();
    var vmes = momentoAtual.getMonth() + 1;
    var vano = momentoAtual.getFullYear();
    
    if (vdia < 10) { vdia = "0" + vdia; }
    if (vmes < 10) { vmes = "0" + vmes; }
    if (vhora < 10) { vhora = "0" + vhora; }
    if (vminuto < 10) { vminuto = "0" + vminuto; }
    if (vsegundo < 10) { vsegundo = "0" + vsegundo; }

    var horaFormat = " " + vhora + ":" + vminuto + ":" + vsegundo;
    var dataFormat = vdia + "/" + vmes + "/" + vano ;

    $("#hora").text(horaFormat);
    $("#data").text(dataFormat);

    setTimeout(atualizaRelogio, 1000);
}

$(document).ready(function(){
    //jquery for toggle sub menus
    $('.sub-btn').click(function(){
      $(this).next('.sub-menu').slideToggle();
      $(this).find('.dropdown').toggleClass('rotate');
    });
    //jquery for expand and collapse the sidebar
    $('.menu-btn').click(function(){
      $('.side-bar').addClass('active');
      $('.menu-btn').css('visibility', 'hidden');
    });
    //Active cancel button
    $('.close-btn').click(function(){
      $('.side-bar').removeClass('active');
      $('.menu-btn').css('visibility', 'visible');
    });
  });