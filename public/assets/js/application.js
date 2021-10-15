$(function () {
    $("#refresh_scoreboard").click(refresh_scoreboard);
    refresh_scoreboard();

    $('.start-game-button').click(function () {
        if ($('#player_name').val().length === 0) {
            return alert('Preencha seu nome primeiro');
        }
        create_player($('#player_name').val(), function (game) {
            window.location.href = window.location + 'game/' + game.uuid;
        });

    });

    $('.btn-step').click(function(){
        var step_button = $(this);
        make_step(step_button.data('option'), function(data){
            step_button.parent().find('.btn-step').each(function(){
                $(this).prop('disabled', true);

            });
            $('.btn-step-'+(step_button.data('step')+1)).prop('disabled', false);

            if(data.status === false){
                step_button.removeClass('btn-primary').addClass('btn-danger');
                $('#gameover_modal').modal({backdrop: 'static', keyboard: false});
            }else if(data.status === true){
                step_button.removeClass('btn-primary').addClass('btn-success');
                $('#winner_modal').modal({backdrop: 'static', keyboard: false});
            }else{
                step_button.removeClass('btn-primary').addClass('btn-success');
            }
        });
    });
});

function refresh_scoreboard() {
    $.ajax({
        method: "GET",
        url: base_url + "/ws/games"
    })
      .done(function (data) {
          console.log(data);
          let scoreboard = $('#scoreboard');
          scoreboard.html('');

          for (let score in data) {
              scoreboard.append($('<tr>')
                .append($('<th scope="row">').append(parseInt(score) + 1))
                .append($('<td>').append(data[score].player_name))
                .append($('<td>').append(data[score].score + '/' + data[score].levels))
                .append($('<td>').append(data[score].status> 0 ? '<b style="color:limegreen"> Vencedor </b>' : '<b style="color:red"> Perdedor </b>'))
              );
          }
      })
      .fail(function () {
          console.log("uh oh it failed");
      })
}

function create_player(name, callback) {
    $.ajax({
        "method": "POST",
        "data": {
            "player_name": name
        },
        // accepts: "application/json; charset=utf-8",
        dataType: 'json',
        url: base_url + "/ws/game"
    })
      .done(callback)
      .fail(function () {
          console.log("uh oh it failed");
      })
}

function make_step(step, callback){
    $.ajax({
        "method": "PUT",
        // accepts: "application/json; charset=utf-8",
        url: base_url + "/ws/game/" + game_uuid + '/step/' + step
    })
      .done(callback)
      .fail(function () {
          alert('falha ao registrar passo');
      })
}
