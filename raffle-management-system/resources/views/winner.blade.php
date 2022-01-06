<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raffle Winners</title>

    <!--Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3">
        <div class="container"> 
            <a href="/" class="navbar-brand">Raffle Winners</a>
        </div>
    </nav>  
  
    <section class="p-5">
        <div class="container">
        @foreach($raffles as $raffle) 
            <h3>{{ $raffle->name }}           
                <span class="badge rounded-pill bg-primary">{{ $raffle->winners }}</span>
            </h3>

            <form action="selecting-winners" id="winner-selection-{{ $raffle->id }}" method="POST">
                @csrf
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach($raffle_entries as $raffle_entry)
                        @if ($raffle->id == $raffle_entry->raffle_id)
                            <input type="checkbox" class="btn-check" id="{{ $raffle_entry->id }}" autocomplete="off"
                                name="contestant_{{ $raffle_entry->raffle_entry_id }}" value="{{ $raffle_entry->full_name }}">
                            <label class="btn btn-outline-primary" for="{{ $raffle_entry->id }}">{{ $raffle_entry->full_name }}</label>
                        @endif
                    @endforeach
                </div>                

                <div class="pt-3 mb-3">
                    <button id="send-winners-{{ $raffle->id }}"type="submit" class="btn btn-primary mb-3">Select Winners</button>
                </div>        
            </form>
        @endforeach
        </div>
    </section>

    <script>
        /* Make sure to not exceed winner limit & submits selected winners */
        @foreach($raffles as $raffle)            
            @foreach($raffle_entries as $raffle_entry)
                @if ($raffle->id == $raffle_entry->raffle_id) 
                    // Add a limit to how many winners can be selected
                    document.getElementById({{ $raffle_entry->id }})
                        .addEventListener('click', () => {
                            console.log({{ $raffle_entry->id }});
                        });
                @endif
            @endforeach

            document.getElementById('send-winners-{{ $raffle->id }}')
                .addEventListener('click', async () => {
                // Prevent page reload
                event.preventDefault();  

                let formData{{ $raffle->id }} = new FormData(document.getElementById('winner-selection-{{ $raffle->id }}')); 

                let winnerData{{ $raffle->id }} = {};

                for (var pair of formData{{ $raffle->id }}.entries()) {
                    winnerData{{ $raffle->id }}[pair[0]] = pair[1]; 
                }
            
                const response = await fetch ('/selecting-winners', {
                    method: 'POST',
                    credentials: "same-origin",
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'url': '/createRaffle',
                        "X-CSRF-Token": document.querySelector('input[name=_token]').value
                    }, 
                    body: JSON.stringify(winnerData{{ $raffle->id }}) 
                });
            });
        @endforeach

    </script>

    <!--JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>