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
            <div class="mx-3 mb-3 dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Raffles
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach($raffles as $raffle)
                        <li><button id={{ $raffle->id }} class="dropdown-item">{{ $raffle->name }}</button></li>
                    @endforeach
                </ul>
            </div>

            <form class="mx-3 mb-3">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="name">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="phone">
                    </div>
                </div>


                <div class="pt-3 col-sm-10">
                    <button type="submit" class="btn btn-primary mb-3">Send Raffle</button>
                </div>        
            </form>
        </div> 
    </section>

    <!--JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>