<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Squid Game - Jogador #{{$game->id}}: {{$game->player_name}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="<?php echo url('/') ?>/assets/css/application.css" rel="stylesheet">
    <!-- Styles -->
    <script>
        var base_url = '<?php echo url('/') ?>';
        var game_uuid = '{{$game->uuid}}';
    </script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="container">
    <br>
    <h1 class="text-center">Jogador #{{$game->id}}: {{$game->player_name}}</h1>
    <h2 class="text-center">Dê os passos para continuar</h2>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            @for($step = 0; $step < $game->levels; $step++)
                <div class="btn-group btn-block d-flex" role="group" aria-label="Basic example">
                    <button data-step="{{$step + 1}}" data-option="A" @if(strlen($game->player_steps) !== $step || $game->status === '0') disabled
                            @endif type="button"
                            class="btn-step-{{$step + 1}} btn-step btn <?php if (strlen($game->player_steps) > $step && $game->player_steps[$step] === 'A') {
                                echo($game->player_steps[$step] === $game->path[$step] ? 'btn-success' : 'btn-danger');
                            } else {
                                echo 'btn-primary';
                            }  ?>  btn-lg w-100">Esquerda
                    </button>
                    <button data-step="{{$step + 1}}" data-option="B" @if(strlen($game->player_steps) !== $step || $game->status === '0') disabled
                            @endif type="button"
                            class="btn-step-{{$step + 1}} btn-step btn <?php if (strlen($game->player_steps) > $step && $game->player_steps[$step] === 'B') {
                                echo($game->player_steps[$step] === $game->path[$step] ? 'btn-success' : 'btn-danger');
                            } else {
                                echo 'btn-primary';
                            }  ?>  btn-lg w-100">Meio
                    </button>
                    <button data-step="{{$step + 1}}" data-option="C" @if(strlen($game->player_steps) !== $step || $game->status === '0') disabled
                            @endif type="button"
                            class="btn-step-{{$step + 1}} btn-step btn <?php if (strlen($game->player_steps) > $step && $game->player_steps[$step] === 'C') {
                                echo($game->player_steps[$step] === $game->path[$step] ? 'btn-success' : 'btn-danger');
                            } else {
                                echo 'btn-primary';
                            }  ?>  btn-lg w-100">Direita
                    </button>
                </div>
            @endfor
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="gameover_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">FIM DE JOGO</h5>
            </div>
            <div class="modal-body">
                <img src="https://media.istockphoto.com/photos/dripping-blood-letters-dead-picture-id157426755" style="width: 100%">
                <p>Você perdeu</p>
            </div>
            <div class="modal-footer">
                <a href="<?php echo url('/') ?>" class="btn btn-primary">Reiniciar Jogo</a>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="winner_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">FIM DE JOGO</h5>
            </div>
            <div class="modal-body">
                <img src="https://previews.123rf.com/images/maxborovkov/maxborovkov1509/maxborovkov150900207/45573198-winner-sign-with-colour-confetti-vector-paper-illustration-.jpg" style="width: 100%">
                <p>Você Ganhou</p>
            </div>
            <div class="modal-footer">
                <a href="<?php echo url('/') ?>" class="btn btn-primary">Reiniciar Jogo</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="<?php echo url('/') ?>/assets/js/application.js"></script>
<script>
    $(function () {
        if(<?php echo $game->status === '0' ? 'true' : 'false' ?>){
            $('#gameover_modal').modal({backdrop: 'static', keyboard: false});
        }
    });
</script>
</body>
</html>
