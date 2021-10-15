$(function(){
    $("#refresh_scoreboard").click(refresh_scoreboard);
    refresh_scoreboard();
});

function refresh_scoreboard(){
    $.ajax({
        method: "GET",
        url: "ws/games"
    })
      .done(function(data){
          console.log(data);
          let scoreboard = $('#scoreboard');
          scoreboard.html('');

          for(let score in data){
              scoreboard.append($('<tr>')
                .append($('<th scope="row">').append(parseInt(score) + 1))
                .append($('<td>').append(data[score].player_name))
                .append($('<td>').append(data[score].score + '/' + data[score].levels))
                .append($('<td>').append(data[score].status === 1 ? 'Vencedor' : 'Perdedor' ))
              );
          }
      })
      .fail(function(){
          console.log("uh oh it failed");
      })
}
