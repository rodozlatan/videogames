<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>VideoGames | Rodolfo Perez</title>
  </head>
  <body>
    <input type="hidden" id="txtPage" value="1" style="margin: auto;
    display: block;">
    <div class="container p-3 py-4">
      <div class="p-5 mb-4 bg-dark text-white rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Video Games Collection</h1>
          <p class="col-md-8 fs-4">Rodolfo Perez</p>
        </div>
      </div>
      <div id="alertContainer"></div>
      <div class="row">
        <div class="col-md-6">
          <fieldset class="p-3 border rounded h-100">
            <legend>Add a Game</legend>
            <form id="mainForm" novalidate>
              <div class="mb-3">
                <label for="txtPublisher" class="form-label">Publisher:*</label>
                <input type="text" class="form-control" id="txtPublisher" aria-describedby="txtPublisherHelp" required pattern="[a-zA-Z][a-zA-Z0-9\s]*">
                <div class="invalid-feedback">
                  Please type a publisher.
                </div>
              </div>
              <div class="mb-3">
                <label for="txtName" class="form-label">Name:*</label>
                <input type="text" class="form-control" id="txtName" aria-describedby="txtNameHelp" required pattern="[a-zA-Z][a-zA-Z0-9\s]*">
                <div class="invalid-feedback">
                  Please type a name.
                </div>
              </div>
              <div class="mb-3">
                <label for="txtNickname" class="form-label">Nickname:</label>
                <input type="text" class="form-control" id="txtNickname">
              </div>
              <div class="mb-3">
                <label for="selectRating" class="form-label">Rating:*</label>
                <select class="form-select form-select-lg mb-3" id="selectRating" aria-label=".form-select-lg example" required>
                  <option selected disabled value="">:Select one:</option>
                  <option value="Favorite">Favorite</option>
                  <option value="Meh">Meh</option>
                  <option value="Dislike">Dislike</option>
                </select>
                <div class="invalid-feedback">
                  Please select a rating.
                </div>
              </div>
              <div class="row p-2">
                <div class="col-md-7 p-1">
                  <button type="button" id="btnSend" class="btn btn-primary p-3 w-100 d-block">Save Game</button>
                </div>
                <div class="col-md-5 p-1">
                  <button type="reset" id="btnReset"  class="btn btn-success p-3 w-100 d-block">Reset</button>
                </div>
              </div>
            </form>
          </fieldset>
        </div>
        <div class="col-md-6">
          <fieldset class="p-3 border rounded h-100">
            <legend>Look for a Game</legend>
            <form>
              <div class="mb-3">
                <label for="txtSearch" class="form-label">Type your search:</label>
                <input type="text" class="form-control" id="txtSearch">
              </div>
            </form>
            <table class="table table-hover table-responsive" id="tableResults">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Publisher</th>
                  <th scope="col">Name</th>
                  <th scope="col">Nickname</th>
                  <th scope="col">Rating</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
            <nav id="navPagination">
            </nav>
          </fieldset>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      (function () {
        'use strict'

        fetchData();

		  const btnSend = document.getElementById('btnSend');
		  btnSend.addEventListener("click", function(event) {
          document.getElementById("alertContainer").innerHTML = '';
          if(!processForm('submit', 'mainForm', event)) return false;
        }, false);

		  const btnReset = document.getElementById('btnReset');
		  btnReset.addEventListener("click", function(event) {
          document.getElementById("alertContainer").innerHTML = '';
          processForm('reset', 'mainForm', event);
        }, false);

		  const txtSearch = document.getElementById('txtSearch');
		  txtSearch.addEventListener("keyup", function(event) {
          document.getElementById("txtPage").value = 1
          fetchData();
        }, false);

        document.addEventListener('click', (event) => {
          if (event.target.className === 'page-link') {
            event.preventDefault();
            if(event.target.getAttribute('data-ci-pagination-page')){
              document.getElementById("txtPage").value = event.target.getAttribute('data-ci-pagination-page');
            }else{
              document.getElementById("txtPage").value = 1;
            }
            fetchData();
          }
        });
      })()

      async function fetchData() {
        document.getElementById("navPagination").innerHTML = '';
		  const page = document.getElementById("txtPage").value;
		  let host = 'http://perez.videogames/';
		  if (!host) {
			  host = 'http://localhost/videogames/';
		  }

		  const response = await fetch(`${host}Ajax/getVideogames/${page}/${document.getElementById('txtSearch').value}`);
        const data = await response.json();
        const tBody = document.querySelector("#tableResults tbody");
        while (tBody.firstChild) {
          tBody.firstChild.remove();
        }
        document.getElementById("navPagination").innerHTML = data.pagination;
        data.result.forEach(obj => {
			const row = document.createElement("tr");
			Object.entries(obj).forEach(([key, value]) => {
				const cell = document.createElement("td");
				const textCell = document.createTextNode(`${value}`);
				cell.appendChild(textCell);
              row.appendChild(cell);
            });
            tBody.appendChild(row);
          });
        }

      function processForm(action, formID, event){
		  const form = document.getElementById(formID);
		  switch(action){
          case 'submit':
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
              form.classList.add('was-validated')
              return false;
            }
            setVideogame();
            break;

          case 'reset':
            form.classList.remove('was-validated')
            break;
        }
        return true;
      }

      async function setVideogame() {
		  const txtName = document.getElementById("txtName").value.trim();
		  const txtPublisher = document.getElementById("txtPublisher").value.trim();
		  const txtNickname = document.getElementById("txtNickname").value.trim();
		  const selectRating = document.getElementById("selectRating").value;
		  let result, alertTitle = "", alertMessage, alertType;
		  let host = 'http://perez.videogames/';
		  if (!host) {
		  	host = 'http://localhost/videogames/';
		  }

		  const response = await fetch(`${host}/Ajax/setVideogame/${txtName}/${txtPublisher}/${selectRating}/${txtNickname}`).then(response => response.json()).then(data => result = data);
		  console.log(result.query);
        if(result.query === true){
          alertTitle    = 'Success! ';
          alertMessage  = 'Videogame added.';
          alertType     =  'alert-success';
        }else{
          console.log(result.query);
          alertTitle    = 'Error! ';
          alertMessage  = 'This videogame already exists.';
          alertType     =  'alert-warning';
        }

        const alertContainer = document.getElementById("alertContainer");
        alertContainer.innerHTML = '';

		  const divAlert = document.createElement("div");
		  divAlert.classList.add('alert');
        divAlert.classList.add(alertType);
        divAlert.classList.add('alert-dismissible');
        divAlert.classList.add('fade');
        divAlert.classList.add('show');
        divAlert.setAttribute('role', 'alert');

	  const alertTitleStrong = document.createElement("strong");
	  const alertTitleText = document.createTextNode(alertTitle);
	  const alertMessageText = document.createTextNode(alertMessage);
	  alertTitleStrong.appendChild(alertTitleText);

		  const alertClose = document.createElement("button");
		  alertClose.classList.add('btn-close');
        alertClose.setAttribute('data-bs-dismiss', 'alert');
        alertClose.setAttribute('aria-label', 'Close');

        divAlert.appendChild(alertTitleStrong);
        divAlert.appendChild(alertMessageText);
        divAlert.appendChild(alertClose);

        alertContainer.appendChild(divAlert);

        await fetchData();
      }
    </script>
  </body>
</html>
