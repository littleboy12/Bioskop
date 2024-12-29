getDataMovies();
  
function getDataMovies() {
  fetch("http://localhost/xx2Cinema/services/Movies.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("data Di terima:", data);
      displayMovies(data);
    });
}

function searchMovies() {
  const search = document.getElementById("search").value.trim();

  fetch(
    `http://localhost/xx2Cinema/services/Movies.php?search=${encodeURIComponent(
      search
    )}`
  )
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("data Di terima:", data);
      displayMovies(data);
    });
}

function displayMovies(data) {
  const result = document.getElementById("filmList");

  result.innerHTML = "";
  data.forEach((film) => {
    result.innerHTML += `
        <div class="col-md-4 film-item">
            <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="${film.poster_url}" alt="Film Poster">
                <div class="card-body">
                <h5 class="card-title">${film.title}</h5>
                <p class="card-text">${film.description}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <button type="button" onclick="showDetail(${film.movie_id})" class="btn btn-sm btn-outline-secondary">View</button>
                    </div>
                    <small class="text-muted">${film.rilis}</small>
                </div>
                </div>
            </div>
        </div>
        `;
  });
}

function showDetail(id_movie) {
  const detail = document.getElementById("detail");
  detail.classList.remove("d-none");

  console.log("ID movie:", id_movie);

  fetch(`http://localhost/xx2Cinema/services/Movies.php?id=${id_movie}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("data Di terima:", data);

      const result = document.getElementById("filmCard");

      result.innerHTML = "";

      data.forEach((film) => {
        result.innerHTML += `
            <img id="filmPoster" s
            rc="${film.poster_url}" style = "hight: 200px" alt="Film Poster">
            <div class="card-body">
                <h5 class="card-title" id="filmTitle">${film.title}</h5>
                <p class="card-text" id="filmDescription">${film.description}</p>
                <p class="release-date" id="filmReleaseDate">Release Date: ${film.release_date}</p>
                
                <p class="duration" id="filmDuration"><strong>Duration:</strong> ${film.duration} minutes</p>
                <p class="genre" id="filmGenre"><strong>Genre:</strong> <span>${film.genre}</span></p>
                <p class="rating" id="filmRating"><strong>Rating:</strong> <span>${film.rating}/10</span></p>
                <div class="btn-group mt-3">
                     <button type="button" onclick="getDataJadwal(${film.movie_id})" class="btn btn-sm btn-outline-secondary">Get Ticket</button>
                     <button type="button" onclick="closeDetail()" class="btn btn-sm btn-outline-danger">Close</button>
                </div>
            </div>
            `;
      });
    });
}

function closeDetail() {
  const detail = document.getElementById("detail");
  detail.classList.add("d-none");
  console.log("close");
}
