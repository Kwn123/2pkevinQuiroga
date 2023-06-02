async function Funcion(){
    //Var
    const infoRam = document.getElementById("infoRam");
    const infoRick = document.getElementById("infoRick");
    var sexRick;
    var sexRam;

    await fetch('https://randomuser.me/api/')
    .then(res => res.json())
    .then(data => {
     
    //Guardo la data en una variable para achicar la busqueda
    resul = data.results[0];

    //Cambio el contenido del div infoRam
    infoRam.innerHTML = `
    <div id="bodyRam">
    <img class="imgRam" style="width: 150px;" src="${resul.picture.large}">
    <p><b>Nombre: </b>${resul.name.first} </p>
    <p><b>Apellido: </b>${resul.name.last} </p>
    <p><b>DNI: </b>${resul.id.value} </p>
    <p><b>Latitud: </b>${resul.location.coordinates.latitude} </p>
    <p><b>Longitud: </b>${resul.location.coordinates.longitude} </p>
    </div>`;

    // Verifico si el mapa esta activo, si este esta activo pongo su valor a null
    var container = L.DomUtil.get('map');
    if(container != null){
        container._leaflet_id = null;
    }

    //--------------------------------------------------------------
    var map = L.map('map').setView([resul.location.coordinates.latitude, resul.location.coordinates.longitude], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'})
    .addTo(map);
    //-----------------------------------------------------------------
    sexRam = resul.gender;
    //Cambio el color segun el genero
    const bodyRam = document.getElementById('bodyRam');
    if(resul.gender == 'male'){
        bodyRam.classList.add('male')
    } else {
        bodyRam.classList.add('female')
    }
    })//Ram

    //Creo una variable para un numero aleatorio
    let numRick;
    numRick = Math.floor(Math.random() * (826 - 1 + 1) + 1);
  


    //Fetch Rick And Morty
    await fetch(`https://rickandmortyapi.com/api/character/${numRick}`)
    .then(res => res.json())
    .then(data => {
        
    //Cambio el contenido de infoRick
    infoRick.innerHTML = `
    <div id="bodyRick">
    <img class="imgRick" style="width: 150px;" src="${data.image}">
    <p><b>Nombre: </b>${data.name} </p>
    <p><b>ID: </b>${data.id} </p>
    <p><b>Especie: </b>${data.species} </p>
    <p><b>Origen: </b>${data.origin.name} </p>
    <p><b>Estado: </b>${data.status} </p>
    </div>`;

    sexRick = data.gender;

    const bodyRick = document.getElementById('bodyRick');
    if(data.gender == 'Male'){
     bodyRick.classList.add('male');
    }else if(data.gender == 'Female'){
     bodyRick.classList.add('female');
    }else {
     bodyRick.classList.add('oter');
    }
    })//rick

    const match = document.getElementById('match');
    //Comparo los generos para ver si hay match
    if(sexRick == 'Male' && sexRam == 'male'){
        match.innerHTML=`
        <img src="Match.png">`
    }else if(sexRick == 'Female' && sexRam == 'female'){
        match.innerHTML=`
        <img src="Match.png">`
    }else{
        match.innerHTML=`
        <img src="nomatch.png">`
    }

    
}
/*------------------------------------------ */
