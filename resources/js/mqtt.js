import mqtt from "mqtt"; // import namespace "mqtt"
import axios from "axios";
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

client.on('message',async  function (topic, message) {
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

    try {
        const response = await axios.post('/data/save', {
            dispositivo: data.Dispositivo,
            id: data.Id,
            timestamp: data.Timestamp,
            ph: data.Data.Ph,
            temperatura: data.Data.Temperatura,
            conductividad: data.Data.Conductividad,
            oxigeno_disuelto: data.Data.OxigenoDisuelto
        });
        console.log('ID de la orden:', response.data.id);
    } catch (error) {
        console.error('Error al crear la orden:', error);
    }
});
