<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quas Factory</title>


  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="{{asset('css/logger.css') }}" rel="stylesheet">  
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




</head>

<body>

        <div class="fondo-1" id="fondo-1"> 
            @yield('nav')
            <button onclick="toggleSidebar()" id="toggleBtn">?</button>

            @yield('sidebar') <!-- Incluir el sidebar -->

            @yield('banner')

        </div>
        <div class="fondo-2" id="fondo-2">
            @yield('casos')
            @yield('cliente')
            @yield('contacto-rapido')
        </div>

      @yield('footer')


      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> <!-- (Opcional) Para tooltips y popovers -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('mySidebar').classList.toggle('active');
    }
</script>

<script>
    // Obtener el contexto del canvas para renderizar el gráfico.
    var ctx = document.getElementById('myChart').getContext('2d');

    // Datos de ejemplo para el gráfico. Puedes dinamizarlos pasándolos desde el controlador.
    var data = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
        datasets: [{
            label: '# de Productos',
            data: [12, 19, 3, 5, 2],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Opciones del gráfico. Puedes personalizarlo según tus necesidades.
    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Crear el gráfico
    var myChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico: bar, line, pie, etc.
        data: data,
        options: options
    });
</script>