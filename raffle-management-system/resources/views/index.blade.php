<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raffle Entry</title>

    <!--Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
   <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3">
        <div class="container"> 
            <a href="/" class="navbar-brand">Raffle Entry</a>
        </div>
   </nav> 

    <section class="p-5">
        <div class="container">
            <form class="mx-3 mb-3" id="raffle-entry" action="submitRaffleEntry" method="POST">
                @csrf
                <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach($raffles as $raffle)
                        <input type="checkbox" class="btn-check" id="{{ $raffle->id }}" 
                            autocomplete="off" name="checkbox_{{ $raffle->id }}" value="{{ $raffle->id }}">
                        <label class="btn btn-outline-primary" for="{{ $raffle->id }}">{{ $raffle->name }}</label>
                    @endforeach
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" id="name" name="full_name"></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" id="phone" name="phone"></textarea>
                    </div>
                </div>

                <div class="pt-3 col-sm-10">
                    <button id="send-raffle" type="submit" class="btn btn-primary mb-3">Send Raffle</button>
                </div>        
            </form>
        </div> 
    </section>

    <script>
        /* Deals with making sure the user can only select two checkboxes */
        let raffleSelected = 0;
        let arr = [];

        @foreach($raffles as $raffle)
            arr.push(document.getElementById({{ $raffle->id }}));
        @endforeach

        for (const raffle of arr) {
            raffle.addEventListener('click', () => {
                if (raffleSelected < 2) {
                    if (raffle.checked == true) {
                        raffleSelected++;
                    } else if (raffle.checked == false) {
                        raffleSelected--;
                    }
                } else if (raffle.checked == false) {
                    raffleSelected--;
                } else {
                    raffle.checked = false;
                }
            });
        }

        // Add event listener when user sends their raffle
        const sendRaffleButton = document.getElementById('send-raffle');
        const raffleEntryForm = document.getElementById('raffle-entry');

        sendRaffleButton.addEventListener('click', async () => {
            // Stop page reload
            event.preventDefault(); 

            let formData = new FormData(raffleEntryForm); 

            let raffleEntryData = {};

            // Make an array of the raffles selected
            let rafflesSelected = [];

            for (const raffle of arr) {
                if (raffle.checked == true) {
                    rafflesSelected.push(raffle.id);                    
                }
            }

            for (var pair of formData.entries()) {
                raffleEntryData[pair[0]] = pair[1]; 
            }

            const response = await fetch('/submitRaffle', {
                method: 'POST',
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'url': '/createRaffle',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify(raffleEntryData)
            });
        });


    </script>

    <!--JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>