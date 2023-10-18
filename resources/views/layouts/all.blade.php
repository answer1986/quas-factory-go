<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quas Factory</title>


<!--script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> <!-- (Opcional) Para tooltips y popovers -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="{{asset('css/logger.css') }}" rel="stylesheet">  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
   <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">




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

    <script>
        var ctxOverall = document.getElementById('overallProgressChart').getContext('2d');
        var overallChart = new Chart(ctxOverall, {
            type: 'doughnut',
            data: {
                labels: ['Promedio de Progreso', 'Restante'],
                datasets: [{
                    data: [promedioProgreso, restante],
                    backgroundColor: ['#007bff', '#e9ecef'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'right'
                },
                cutoutPercentage: 80
            }
        });
    </script>

    <script>
        var totalEstruccion = 0;
        var totalSellado = 0;
        var totalMicroperforado = 0;

        var countEstruccion = 0;
        var countSellado = 0;
        var countMicroperforado = 0;

        @foreach($ordenes ?? [] ?? [] as $orden)
            @if($orden->tipo_proceso == 'Estruccion')
                totalEstruccion += {{ $orden->porcentaje_progreso }};
                countEstruccion++;
            @elseif($orden->tipo_proceso == 'Sellado')
                totalSellado += {{ $orden->porcentaje_progreso }};
                countSellado++;
            @elseif($orden->tipo_proceso == 'Microperforado')
                totalMicroperforado += {{ $orden->porcentaje_progreso }};
                countMicroperforado++;
            @endif
        @endforeach

        var promedioEstruccion = countEstruccion > 0 ? totalEstruccion / countEstruccion : 0;
        var promedioSellado = countSellado > 0 ? totalSellado / countSellado : 0;
        var promedioMicroperforado = countMicroperforado > 0 ? totalMicroperforado / countMicroperforado : 0;
    </script>



    <script>
        // Actualizar la visualización del porcentaje en las barras de progreso
        document.getElementById('estrPercentage').textContent = promedioEstruccion.toFixed(2);
        document.getElementById('sellPercentage').textContent = promedioSellado.toFixed(2);
        document.getElementById('microPercentage').textContent = promedioMicroperforado.toFixed(2);
    </script>

    <script>
            // Calcular el progreso promedio
            var totalProgreso = 0;
            var totalOrdenes = {{ count($ordenes ?? [] ?? []) }};

            @foreach($ordenes ?? [] ?? [] as $orden)
                totalProgreso += {{ $orden->porcentaje_progreso }};
            @endforeach

            var promedioProgreso = totalProgreso / totalOrdenes;
            var restante = 100 - promedioProgreso;
    </script>

        <script>
                document.addEventListener("DOMContentLoaded", function() {
                // Datos ficticios, deberás obtener estos desde tu backend o una API.
                var ordenes = @json($ordenes ?? []);

                // Extrae los números OC y los porcentajes de eficiencia para el gráfico.
                var labels = ordenes.map(function(orden) { return orden.numero_oc; });
                var data = ordenes.map(function(orden) { return orden.porcentaje_progreso; });

                // Configuración del gráfico.
                var ctx = document.getElementById('eficienciaChart').getContext('2d');
                var eficienciaChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '% de Eficiencia',
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100  // Considerando que el porcentaje no supera el 100%
                            }
                        }
                    }
                });
            });

        
        </script>

 <!-- calendario-->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: "{{ route('calendario.data') }}"
            });
            calendar.render();
        });

    </script>



</body>
</html>