<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="page/main.css">

    <title> <?php echo $data['pageInfo']['title']; ?> </title>
  </head>
  <body>

   <!--  <div id="main" class = "container"> -->

      <div class="container"> 
        <h1> <?php echo $data['pageInfo']['h1page']; ?>  </h1> 
      </div>

      <div class="container">
        <h2> <?php echo $data['openWeather']['h2Weather']; ?> </h2>
        <?php echo $data['openWeather']['outputDataWeather']; ?>

        <br/>
        <p> N.C. : Non communiqué.</p>
      </div>

      <div class="container">
        <h2> <?php echo $data['cityMapper']['h2CityMapper'];  ?> </h2>
        <?php echo $data['cityMapper']['outputDataCityMapper'];  ?>
      </div>

      <div class="container"> 
        <i> <?php echo $data['pageInfo']['updateData']; ?>  </i> 
      </div>

    <!-- </div> -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

  <footer> Jonathan Dancette Project, all rights reserved. Sources : OpenWeather & CityMapper API. </footer>