<?php
header('Content-Type: text/html; charset=utf-8');

// Conexión única a Google Cloud
$servername = "35.226.253.223"; 
$username = "root";
$password = "Hola098.com"; // Tu contraseña real
$dbname = "chatbot"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Error de conexión"); }
$conn->set_charset("utf8");

$pregunta = isset($_POST['mensaje']) ? $conn->real_escape_string(mb_strtolower($_POST['mensaje'])) : '';

if ($pregunta !== '') {
    $pregunta_min = $pregunta; // Elimina los mensajes de "Warning"
s
}
$conn->close();
s    
    // Aquí van todas tus condiciones de (hola, envío, pago, productos, etc.)
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Conexión fallida: " . $conn->connect_error); }
$conn->set_charset("utf8");

// Recibimos la pregunta y la convertimos a minúsculas una sola vez
$pregunta = isset($_POST['mensaje']) ? $conn->real_escape_string(mb_strtolower($_POST['mensaje'])) : '';

if ($pregunta !== '') {
    // Definimos pregunta_min para que todas tus condiciones funcionen
    $pregunta_min = $pregunta;

    // --- 1. INTERACCIONES DE AMABILIDAD Y SALUDO ---
    if (strpos($pregunta_min, 'hola') !== false || strpos($pregunta_min, 'buen') !== false) {
        echo "¡Hola! Bienvenida a Hola Bonita ✨. ¿En qué puedo ayudarte hoy? Para asesorarte mejor, cuéntame: <b>¿Cómo siente su piel por las mañanas?</b> (Tirante, con brillo en la zona T, grasa o cómoda). ";
    }
    elseif (strpos($pregunta_min, 'gracias') !== false || strpos($pregunta_min, 'adiós') !== false || strpos($pregunta_min, 'adios') !== false) {
        echo "¡De nada! Fue un gusto ayudarte. 😊 ¿Te puedo ayudar en algo más o tienes alguna otra duda sobre tu rutina? ";
    }
    elseif (strpos($pregunta_min, 'buen día') !== false || strpos($pregunta_min, 'lindo día') !== false) {
        echo "¡Igualmente para ti! Que tengas un día maravilloso. ¿Hay algún otro producto que quieras consultar antes de irte? ";
    }

    // --- 2. ASESORÍA ESPECÍFICA Y SEGURIDAD ---
    elseif (strpos($pregunta_min, 'embarazo') !== false) {
        echo "Es seguro usar la mayoría de nuestros productos, pero recomendamos evitar el Retinol y consultar con su médico.";
    }
    elseif (strpos($pregunta_min, 'retinol') !== false && strpos($pregunta_min, 'vitamina c') !== false) {
        echo "No se recomienda combinarlos en la misma rutina. Usa Vitamina C de día y Retinol de noche. ";
    }
    elseif (strpos($pregunta_min, 'devolución') !== false || strpos($pregunta_min, 'reacción') !== false) {
        echo "Sí, tenemos una política de devoluciones si el producto te causa una reacción alérgica en las primeras 48 horas. ";
    }

    // --- 3. UBICACIÓN Y PAGOS ---
    elseif (strpos($pregunta_min, 'donde') !== false || strpos($pregunta_min, 'ubicación') !== false || strpos($pregunta_min, 'local') !== false) {
        echo "📍 **Nuestra Ubicación:** Estamos ubicados en el centro de Los Reyes, Av. Principal. ¡Te esperamos! ";
    }
    elseif (strpos($pregunta_min, 'pago') !== false || strpos($pregunta_min, 'pagar') !== false || strpos($pregunta_min, 'efectivo') !== false) {
        echo "💳 **Formas de Pago:** <br> - **Contrareembolso:** Pagas al recibir.<br> - **Tarjetas de Regalo.** <br> - **Efectivo** en local. ";
    }

    // --- 4. RECOMENDACIONES Y LOGÍSTICA ---
    elseif (strpos($pregunta_min, 'mejor') !== false || strpos($pregunta_min, 'vendido') !== false) {
        echo "🔥 **Nuestros Mejores Productos:** <br> - Niacinamide ($5.70) <br> - Natural Moisturizing ($4.60).";
    }
    elseif (strpos($pregunta_min, 'envío gratis') !== false || strpos($pregunta_min, 'gratis') !== false) {
        echo "🚚 **Envío:** ¡Envío gratuito en pedidos superiores a $600! ";
    }
    elseif (strpos($pregunta_min, 'ayuda') !== false || strpos($pregunta_min, 'contacto') !== false) {
        echo "📞 **Soporte:** Llámanos al <b>2721201331</b>. Estamos disponibles 24/7. ";
    }

    // --- 5. BÚSQUEDA EN BASE DE DATOS (Si no es ninguna de las anteriores) ---
    else {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%$pregunta%' OR funcion LIKE '%$pregunta%'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "🌸 <b>" . $row['nombre'] . "</b><br>";
                echo "💰 Precio: $" . $row['precio'] . "<br>";
                echo "✨ Uso: " . $row['funcion'] . "<br><br>";
            }
        } else {
            echo "Lo siento, ese producto no está disponible. 😔 ¿Te gustaría ver otras opciones similares? [cite: 1]";
        }
    }
}
$conn->close();
?>
