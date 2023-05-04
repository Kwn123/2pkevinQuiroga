
 function Rick() {
  var x
   const idChar = document.getElementById("idChar").value;
   const url = `https://rickandmortyapi.com/api/character/${idChar}`;
   fetch(url)
       .then(res => res.json())
       .then(data => {
           const charInfo = document.getElementById("charInfo");
           charInfo.innerHTML =`
           <div class="card" >
           <img src="${data.image}" class="card-img-top">
           <div class="card-body">
             <h2 class="card-title"><b>${data.name}</b></h2>
             <p class="card-text"><b>Estado: </b>${data.status}</p>
             <p class="card-text"><b>Genero: </b>${data.gender}</p>
             <p><b>Episodios: </b>Aparece en  ${data.episode.length} episodios</p>
           </div>
         </div>
         `
       })
 }

