import mqtt from "mqtt"; // import namespace "mqtt"
import "flowbite";
import "flowbite/dist/flowbite.min.js";
import ApexCharts from "apexcharts";
import axios from "axios";

let globalPhData = [];
let globalTemperaturaData = [];
let globalOxigenoDisueltoData = [];
let globalConductividadData = [];

function fetchData() {
    //return 
    axios.get('/data/getAll')
        .then(function (response) {
            console.log('Datos recibidos:', response.data);
            // Almacenar los datos globalmente
            globalPhData = response.data.ph;
            globalTemperaturaData = response.data.temperatura;
            globalOxigenoDisueltoData = response.data.oxigenoDisuelto;
            globalConductividadData = response.data.conductividad;
            return response.data;  // Devuelve directamente los datos de la respuesta.
        })
        .catch(function (error) {
            console.error('Error al obtener los datos:', error);
            throw error;  // Relanza el error para poder capturarlo más adelante si es necesario.
        });
}

// Ejemplo de uso de los datos globales en otra función
function processData() {
    // Aquí puedes acceder a los datos globales
    console.log('pH data:', globalPhData);
    console.log('Temperatura data:', globalTemperaturaData);
    console.log('Oxígeno Disuelto data:', globalOxigenoDisueltoData);
    console.log('Conductividad data:', globalConductividadData);

    // Realiza el procesamiento que necesites con los datos
    // Por ejemplo, calcular el promedio del pH
    const phPromedio = globalPhData.reduce((sum, value) => sum + value, 0) / globalPhData.length;
    console.log('Promedio del pH:', phPromedio);
}

// Llamar a fetchData y luego procesar los datos
// fetchData().then(() => {
//     processData();
// });


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
    console.log("Mensaje recibido:", message.toString());
    const data = JSON.parse(message.toString());

    axios.post('/data/save', {
        dispositivo: data.Dispositivo,
        id: data.Id,
        timestamp: data.Timestamp,
        ph: data.Data.Ph,
        temperatura: data.Data.Temperatura,
        conductividad: data.Data.Conductividad,
        oxigeno_disuelto: data.Data.OxigenoDisuelto
    })
    .then(function (response) {
    console.log(response);
    })
    .catch(function (error) {
    console.log(error);
    });    
    
    const tableBody = document.getElementById("data-body");

    // Crear una nueva fila
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">${data.Dispositivo}</td>
        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${data.Timestamp}</td>
        <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">${data.Data.Ph}</td>
        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${data.Data.Temperatura}</td>
        <td class="inline-flex items-center p-4 space-x-2 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${data.Data.Conductividad}</td>
        <td class="p-4 whitespace-nowrap">${data.Data.OxigenoDisuelto}</td>
    `;

    // Agregar la nueva fila al principio del cuerpo de la tabla
    tableBody.insertBefore(newRow, tableBody.firstChild);

    // Mostrar scroll solo si hay datos
    const overflowDiv = document.querySelector(".overflow-y-auto");
    if (tableBody.children.length > 0) {
        overflowDiv.style.overflowY = "auto";
    } else {
        overflowDiv.style.overflowY = "hidden";
    }
    fetchData();
    processData();

});