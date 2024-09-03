const filas = 5; // Número de filas en el mapa de pesca
        const columnas = 5; // Número de columnas en el mapa de pesca
        let posicionSeleccionada = null;
        let puntos = 0;
        let tiburonesAtrap = 0;
    
        // Generar el mapa de pesca
        const mapa = document.getElementById('mapa-pesca');
        for (let i = 0; i < filas; i++) {
            for (let j = 0; j < columnas; j++) {
                const celda = document.createElement('div');
                celda.classList.add('celda');
                celda.dataset.fila = i;
                celda.dataset.columna = j;
                celda.addEventListener('click', seleccionarPosicion);
                mapa.appendChild(celda);
            }
        }
    
        function seleccionarPosicion(evento) {
            // Limpiar la selección anterior
            if (posicionSeleccionada) {
                posicionSeleccionada.classList.remove('seleccionada');
            }
            // Marcar la nueva celda seleccionada
            posicionSeleccionada = evento.target;
            posicionSeleccionada.classList.add('seleccionada');
        }
    
        document.getElementById('boton-pescar').addEventListener('click', pescar);
    
        
            function pescar() {
                if (!posicionSeleccionada) {
                    alert('Por favor, selecciona una posición para pescar.');
                    return;
                }
            
                // Generar una posición aleatoria para el pez
                const filaAleatoria = Math.floor(Math.random() * filas);
                const columnaAleatoria = Math.floor(Math.random() * columnas);

                const filaAleatoria1 = Math.floor(Math.random() * filas);
                const columnaAleatoria1 = Math.floor(Math.random() * columnas);

                const filaAleatoria2 = Math.floor(Math.random() * filas);
                const columnaAleatoria2 = Math.floor(Math.random() * columnas);

                const filaAleatoria3 = Math.floor(Math.random() * filas);
                const columnaAleatoria3 = Math.floor(Math.random() * columnas);
            
                const pezMalo1 = Math.random() < 0.4; // 20% de probabilidad de pez malo
                const pezMalo2 = Math.random() < 0.4;
                const pezMalo3 = Math.random() < 0.3;
                // Obtener la celda aleatoria
                const celdaAleatoria = mapa.querySelector(`[data-fila='${filaAleatoria}'][data-columna='${columnaAleatoria}']`);
                const celdaAleatoria1 = mapa.querySelector(`[data-fila='${filaAleatoria1}'][data-columna='${columnaAleatoria1}']`);
                const celdaAleatoria2 = mapa.querySelector(`[data-fila='${filaAleatoria2}'][data-columna='${columnaAleatoria2}']`);
                const celdaAleatoria3 = mapa.querySelector(`[data-fila='${filaAleatoria3}'][data-columna='${columnaAleatoria3}']`);

                // Mostrar la imagen del pez o tiburón en la celda correspondiente
                if (pezMalo1) {
                    celdaAleatoria.classList.add('tiburon');
                } else {
                    celdaAleatoria.classList.add('pez');
                }

                if (pezMalo2) {
                    celdaAleatoria1.classList.add('tiburon');
                } else {
                    celdaAleatoria1.classList.add('pez');
                }

                if (pezMalo3) {
                    celdaAleatoria2.classList.add('tiburon');
                } else {
                    celdaAleatoria2.classList.add('pez');
                }

                celdaAleatoria3.classList.add('pez');



            
                // Mostrar el resultado y actualizar puntos
                const resultado = document.getElementById('resultado');
                if (posicionSeleccionada.dataset.fila == filaAleatoria &&
                    posicionSeleccionada.dataset.columna == columnaAleatoria) {
                    if (pezMalo1) {
                        resultado.innerText = '¡Oh no! Pescaste un tiburon. ¡Perdiste!';
                        tiburonesAtrap++;
                        //reiniciarJuego();
                    } else {
                        resultado.innerText = '¡Felicidades! Pescaste un buen pez.';
                        puntos++;
                    }
                }else if (posicionSeleccionada.dataset.fila == filaAleatoria1 &&
                    posicionSeleccionada.dataset.columna == columnaAleatoria1) {
                    if (pezMalo2) {
                        resultado.innerText = '¡Oh no! Pescaste un tiburon. ¡Perdiste!';
                        tiburonesAtrap++;
                        //reiniciarJuego();
                    } else {
                        resultado.innerText = '¡Felicidades! Pescaste un buen pez.';
                        puntos++;
                    }
                } else if (posicionSeleccionada.dataset.fila == filaAleatoria2 &&
                    posicionSeleccionada.dataset.columna == columnaAleatoria2) {
                    if (pezMalo3) {
                        resultado.innerText = '¡Oh no! Pescaste un tiburon. ¡Perdiste!';
                        tiburonesAtrap++;
                        //reiniciarJuego();
                    } else {
                        resultado.innerText = '¡Felicidades! Pescaste un buen pez.';
                        puntos++;
                    }
                } else if (posicionSeleccionada.dataset.fila == filaAleatoria3 &&
                    posicionSeleccionada.dataset.columna == columnaAleatoria3) {
                        resultado.innerText = '¡Felicidades! Pescaste un buen pez.';
                        puntos++;
                    }else {
                        resultado.innerText = 'No pescaste nada. Inténtalo de nuevo.';
                    }

            
                document.getElementById('puntos').innerText = 'Peces Atrapados: ' + puntos;
                document.getElementById('tibA').innerText = 'Tiburones Atrapados: ' + tiburonesAtrap;
            
                // Remover la imagen del pez o tiburón después de 2 segundos
                setTimeout(() => {
                    celdaAleatoria.classList.remove('pez','tiburon');
                    celdaAleatoria1.classList.remove('pez','tiburon');
                    celdaAleatoria2.classList.remove('pez','tiburon');
                    celdaAleatoria3.classList.remove('pez','tiburon');
                }, 2000);
            }



            let tiempo = 0;
            let intervalo;
            
            function iniciarTemporizador() {
                tiempo = 0;
                clearInterval(intervalo); // Reinicia el intervalo si ya estaba corriendo
                intervalo = setInterval(function() {
                    tiempo++;
                    document.getElementById('tempo').innerText = 'Tiempo: ' + tiempo + 's';
                }, 1000);
            }

            function detenerTemporizador() {
                clearInterval(intervalo);
            }
            
            function reiniciarJuego() {
                detenerTemporizador(); // Detiene el temporizador al perder
                iniciarTemporizador(); // Inicia el temporizador de nuevo
                // Otras lógicas de reinicio de juego, como restablecer puntos, limpiar celdas, etc.
            }

            iniciarTemporizador();

            document.getElementById('terminar-juego').addEventListener('click', function(event) {
                document.getElementById('peces').value = puntos; // Asigna la cantidad de peces atrapados
                document.getElementById('tiburones').value = tiburonesAtrap; // Asigna la cantidad de tiburones atrapados
                document.getElementById('tiempo').value = tiempo; // Asigna el tiempo jugado
                const urlParams = new URLSearchParams(window.location.search);
                document.getElementById('nombre').value = urlParams.get('usuario'); // Captura el nombre desde la URL
            });