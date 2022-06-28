function validForm() {
	//je récupere les elements coté JS
	let formToCheck = document.querySelector("#formToCheck");
	let mail = document.querySelector("#mail");
	let name = document.querySelector("#name");	
    let mdp = document.querySelector("#mdp");
	let error = document.querySelector(".error");

	//je fais mes verif de champs
	let isOk = true;
	let msg = "";
		//on fais nos verif
		if (mail.value === "") {
			//mail
			isOk = false;
			}

			if (name.value === "") {
				//name
				isOk = false;
				}

			if (mdp.value === "") {
				//mdp
				isOk = false;
				}

			//verif ok?
			if (isOk) {
				return true;
			} else {
				error.textContent = "Veuillez vérifier votre saisie";
				return false;
			}
		}