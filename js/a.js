        // Función para cambiar los colores del degradado cada cierto intervalo
        function changeGradient() {
            const colors = ['#f06', '#09f', '#0c6', '#f80'];
            const index = Math.floor(Math.random() * colors.length);
            document.body.style.backgroundImage = `linear-gradient(-45deg, ${colors[index]}, ${colors[(index + 1) % colors.length]}, ${colors[(index + 2) % colors.length]}, ${colors[(index + 3) % colors.length]})`;
        }

        // Cambiar el degradado cada 5 segundos (5000 ms)
        setInterval(changeGradient, 5000);