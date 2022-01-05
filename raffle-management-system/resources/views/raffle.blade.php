<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raffle Creation</title>
    
    <!--Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3">
        <div class="container"> 
            <a href="/" class="navbar-brand">Raffle Creation</a>
        </div>
   </nav>  

    <section class="p-5">
        <div class="container">
            <form class="mx-3 mb-3 form-control" id="raffleCreator" action="createRaffle" method="POST">
                @csrf 
                <label for="name" class="form-label">Raffle Name</label>
                <textarea class="form-control" name="raffle_name" rows="3"></textarea>

                <label class="form-label pt-3">Winners: </label>
                <input type="number" name="numOfWinners" required>


                <div class="pt-3 col-sm-10">
                    <button type="submit" id="raffle-button" class="btn btn-primary mb-3">Create Raffle</button>
                </div>
            </form>
        </div>
    </section>


    <!--Uses JS to create raffle-->
    <script>
        // Grabs the form and button
        const raffleButton = document.getElementById('raffle-button');
        const raffleForm = document.getElementById('raffleCreator');

        raffleButton.addEventListener('click', async () => {
            // Stops the page from reloading
            event.preventDefault();

            let formData = new FormData(raffleForm);

            let raffleData = {};

            for (var pair of formData.entries()) {
                raffleData[pair[0]] = pair[1];
            }

            // Creates the raffle asynchroniously 
            const response = await fetch('/createRaffle', {
                method: 'POST',
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'url': '/createRaffle',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify(raffleData)
            })
            .catch(function(error) {
                console.log('Error: ', error);
            });
        });        

    </script>

    <!--JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>