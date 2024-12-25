var tickets = [];
var get_id_movie = null;

function getDataJadwal(id_movie) {
  closeDetail();
  get_id_movie = id_movie;

  const buyTickets = document.getElementById("buyTickets");
  buyTickets.classList.remove("d-none");

  fetch(`http://localhost/xx2Cinema/services/Seats.php?Jadwal=${id_movie}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("Jadwal Di terima:", data);
      const result = document.getElementById("jadwal");
      result.innerHTML = "";

      data.forEach((jadwal) => {
        result.innerHTML = `
          <button class="btn btn-outline-primary rounded justify-content-center align-items-center d-flex" style="height: 25px" onclick="getTickets(${jadwal.schedule_id})">
              <span>${jadwal.show_time}</span>
          </button>
          `;
      });
    });
}

function getTickets(id_jadwal) {
  console.log("ID jadwal:", id_jadwal);

  fetch(`http://localhost/xx2Cinema/services/Seats.php?tickets=${id_jadwal}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("tiket Di terima:", data);
      tickets = data;
      getDataSeat();
    });
}

function getDataSeat() {
  fetch(`http://localhost/xx2Cinema/services/Seats.php`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("Seats Di terima:", data);
      displaySeats(data);
    });
}

function displaySeats(data) {
  const result = document.getElementById("seat");
  const maxColumns = 5;
  console.log("DATA MOVIE : ", get_id_movie);
  
  console.log("TICKET DI ARRAY : ", tickets);

  let row;

  data.forEach((seat, index) => {
    if (index % maxColumns === 0) {
      row = document.createElement("div");
      row.className = "row mt-2";
      result.appendChild(row);
    }

    const isBooked = tickets.some((ticket) => ticket.seat_id === seat.seat_id && ticket.status === "booked");

    const col = document.createElement("div");

    col.className = "col-sm";
    col.innerHTML = `
          <button class="btn ${isBooked ? 'btn-outline-warning' : 'btn-warning'} rounded justify-content-center align-items-center d-flex" onclick="soldOut(${isBooked})" style="width: 50px; height: 50px">
              <span>${seat.seat_number}</span>
          </button>
          `;
    row.appendChild(col);
  });
}

function soldOut(isBooked) {
    console.log("isBooked", isBooked);
    
    if(!isBooked) {
        alert("Seat is already booked");
    } else {
        alert("Seat is already booked");
    }
}

function closeDetailBook() {
    const detail = document.getElementById("buyTickets");
    detail.classList.add("d-none");
    tickets = [];
    get_id_movie = null;
    console.log("close");
  }
