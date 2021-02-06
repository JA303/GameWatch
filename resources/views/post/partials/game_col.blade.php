<div class="col-lg-3 col-6  p-1" >
    <a href="{{ route('games.show', $game) }}">
        <div class="game-container">
            <div class="game-container-image">
                <img  class="game-container-image" src="{{ asset('uploads/games/'.$game->header) }}" alt=""> <!-- Game Image -->
            </div>
            <div class="game-container-Title "><h5>{{{ $game->title }}}</h5></div> <!-- Games Name -->
            <div class="game-container-Description"><span>{{ $game->game_studio_name }}</span></div>  <!-- Publisher -->
            <div class="game-container-state
            <?php
                if($game->state() == 'unreleased')
                    echo "unreleased";
                elseif($game->state() == 'uncracked')
                    echo "uncracked";
                else
                    echo "released";
            ?>"> </div>   <!-- status(release, unreleased, uncracked) -->
        </div>
    </a>
</div>

