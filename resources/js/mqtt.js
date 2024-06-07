import mqtt from "mqtt"; // import namespace "mqtt"
// Conexión al broker MQTT
const client = mqtt.connect('wss://broker.emqx.io:8084/mqtt');

client.on('connect', function () {
    console.log('Conectado al broker MQTT');
    client.subscribe('salida/01', function (err) {
        if (!err) {
            console.log('Suscrito al tema salida/01');
        }
    });
});

client.on('message', function (topic, message) {
    // Mensaje recibido
    console.log('Mensaje recibido:', message.toString());
    const data = JSON.parse(message.toString());

    document.getElementById('device').innerText = data.Dispositivo;
    document.getElementById('id').innerText = data.Id;
    document.getElementById('timestamp').innerText = data.Timestamp;
    document.getElementById('ph').innerText = data.Data.Ph;
    document.getElementById('temperature').innerText = data.Data.Temperatura;
    document.getElementById('conductivity').innerText = data.Data.Conductividad;
    document.getElementById('oxygen').innerText = data.Data.OxigenoDisuelto;
});