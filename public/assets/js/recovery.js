
// RECOVERY PASO 1
$(document).ready(function() {
	$(document).on('submit', '#frmRecovery', function(event) {
		event.preventDefault();
		userr = $("#usuariorecovery").val();
		if (userr != "") {
			$.ajax({
				url: `${RUTA}/login/recuperarpass`,
				type: 'POST',
				dataType: 'JSON',
				data: {user: userr},
			})
			.done(function(data) {
				if(data.status){
					window.location = `${RUTA}/login/recovery`;
				}else{
					Lobibox.notify('error', {
					    msg: data.response
					});
					// console.log(data);
				}
			})
			.fail(function() {
				Lobibox.notify('error', {
					    msg: "Error al conectar con el servidor"
					});
			});
				
		}else{
			Lobibox.notify('error', {
				    msg: '¡Nombre de usuario requerido!'
				});
		}
	});
});

// RECOVERY PASO 2
$(document).ready(function() {
	$(document).on('submit', '#frmRecoveryPassword', function(event) {
		event.preventDefault();
		answer1 = $("#respuesta1").val();
		answer2 = $("#respuesta2").val();
		answer3 = $("#respuesta3").val();
		
		if (answer1 != "") {
			if (answer2 != "") {
				if (answer3 != "") {
					$.ajax({
						url: `${RUTA}/login/recuperarpassword`,
						type: 'POST',
						dataType: 'JSON',
						data: {ans1: answer1, ans2: answer2, ans3: answer3},
					})
					.done(function(data) {
						if(data.status){
							window.location = `${RUTA}/login/recovery`;
						}else{
							Lobibox.notify('error', {
							    msg: data.response
							});
							// console.log(data);
						}
					})
					.fail(function() {
						Lobibox.notify('error', {
							    msg: "Error al conectar con el servidor"
							});
					});

				}else{
				Lobibox.notify('error', {
					    msg: '¡Responda la Pregunta 3, por favor!'
					});
				}

			}else{
			Lobibox.notify('error', {
				    msg: '¡Responda la Pregunta 2, por favor!'
				});
			}
			
		}else{
			Lobibox.notify('error', {
				    msg: '¡Responda la Pregunta 1, por favor!'
				});
		}
	});
});

// RECOVERY PASO 3
$(document).ready(function() {
	$(document).on('submit', '#frmSETPassword', function(event) {
		event.preventDefault();
		username = $("#usuario").val();
		password = $("#password").val();
		password1 = $("#password-2").val();
		const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$*&])[A-Za-z\d$*&]{8,}$/
		
		
		if (username != "") {
			if (password != "") {
				if (!regex.test(password)) {
					Lobibox.notify('error', {
						msg: "Contraseña inválida"
					});
					return false
				}
				if (password1 != "") {
					$.ajax({
						url: `${RUTA}/login/recuperarSETpassword`,
						type: 'POST',
						dataType: 'JSON',
						data: {user: username, pass: password, pass1: password1},
					})
					.done(function(data) {
						if(data.status){
							Lobibox.alert('success', {
							    msg: "¡Contraseña restablecida exitosamente!"
							})
							window.location = `${RUTA}/login/index`;
						}else{
							Lobibox.notify('error', {
							    msg: data.response
							});
							// console.log(data)
						}
					})
					.fail(function() {
						Lobibox.notify('error', {
							    msg: "Error al conectar con el servidor"
							});
					});
				}else{
				Lobibox.notify('error', {
					    msg: '¡La Contraseña de confirmación no puede estar vacía!'
					});
				}

			}else{
			Lobibox.notify('error', {
				    msg: '¡La Contraseña no puede estar vacía!'
				});
			}
			
		}else{
			Lobibox.notify('error', {
				    msg: '¡El usuario no puede estar vacío!'
				});
		}
	});
});




// CHANGE PASSWORD
$(document).ready(function() {
	$(document).on('submit', '#frmChangePass', function(event) {
		event.preventDefault();
		username = $("#usuario").val();
		password0 = $("#password-0").val();
		password = $("#password").val();
		password1 = $("#password-2").val();
		const regex = RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/);
		
		if (password.trim() === "") {
			Lobibox.notify('error', {
				msg: "La contraseña no puede estar vacía",
				title: '¡Error!'
			});
		}
		else if (password.length < 8 || password.length > 16) {
			Lobibox.notify('error', {
				msg: "La contraseña debe tener entre 8 y 16 caracteres",
				title: '¡Error!'
			});
		}
		else if (!regex.test(password)) {
			Lobibox.notify('error', {
				msg: "Contraseña inválida (Debe tener mínino 1 letra mayúscula y minúscula, 1 número y 1 caracter especial)",
				title: '¡Error!'
			});
		}
		else if (password !== password1) {
			Lobibox.notify('error', {
				msg: "Las contraseñas no coinciden",
				title: '¡Error!'
			});
		}
		else {
			$.ajax({
				url: `${RUTA}/login/changepass`,
				type: 'POST',
				dataType: 'JSON',
				data: { current_pass: password0, new_pass: password, new_pass1: password1 },
			})
			.done(function (data) {
				if (data.status) {
					Lobibox.alert('success', {
						msg: "¡Cambio de contraseña realizado exitosamente!",
						title: '¡Exitoso!'
					})
					window.location = `${RUTA}/login/recovery`;				
				}
				else {
					Lobibox.notify('error', {
						msg: data.response,
						title: '¡Error!'
					});
				}
			})
			.fail(function () {
				Lobibox.notify('error', {
					msg: "Error al conectar con el servidor",
					title: '¡Error!'
				});
			});	
		}
	});
});



// ESTABLECER PREGUNTAS DE SEGURIDAD
$(document).ready(function() {
	$(document).on('submit', '#frmSETPS', function(event) {
		event.preventDefault();
		q11 = $("#PSpregunta1").val(); 
		q22 = $("#PSpregunta2").val(); 
		q33 = $("#PSpregunta3").val(); 
		a11 = $("#PSrespuesta1").val();
		a22 = $("#PSrespuesta2").val();
		a33 = $("#PSrespuesta3").val();
		actionn = ("frmSETPS");

		if (q11 != "" && q22 != "" && q33 != "") {
			if (a11 != "" && a22 != "" && a33 != "") {
				$.ajax({
					url: `${RUTA}/login/setpreguntasrecovery`,
					type: 'POST',
					dataType: 'JSON',
					data: {q1 :q11, q2 :q22, q3 :q33, a1 :a11, a2 :a22, a3 :a33, action :actionn},
				})
				.done(function(data) {
					if(data.status){
						Lobibox.alert('success', {
							msg: "¡Preguntas de Seguridad establecidas exitosamente!",
							title: '¡Exitoso!'
						})
						window.location = `${RUTA}/main/index`;
					}else{
						Lobibox.notify('error', {
						    msg: data.response,					    
							title: '¡Error!'
						});
						// console.log(data);
					}
				})
				.fail(function() {
					Lobibox.notify('error', {
						    msg: "Error al conectar con el servidor",
						    title: '¡Error!'
						});
				});
				
			}else{
				Lobibox.notify('error', {
				    msg: '¡Complete todas las respuestas!',
				    title: '¡Error!'
				});
				//console.log("Password requerida");
			}
		}else{
			Lobibox.notify('error', {
				    msg: '¡Complete todas las preguntas de seguridad!',
				    title: '¡Error!'
				});
			//console.log("Username requerido");
		}
	});
});

const showPasswordBtn0 = document.getElementById("show-pass-btn-0")
const inputPassword0 = document.getElementById("password-0")
const eyeImage0 = document.querySelector(".form__input__eye-img-0")

const showPasswordBtn1 = document.getElementById("show-pass-btn-1")
const inputPassword1 = document.getElementById("password")
const eyeImage1 = document.querySelector(".form__input__eye-img")

const showPasswordBtn2 = document.getElementById("show-pass-btn-2")
const inputPassword2 = document.getElementById("password-2")
const eyeImage2 = document.querySelector(".form__input__eye-img-2")

// Datos de las imagenes para el ojo
const imagesData = {
    eye: {
        url: `${IMG_URL}eye.svg`,
        alt: "Ver contraseña"
    },
    eyeOff: {
        url: `${IMG_URL}eye-off.svg`,
        alt: "Ocultar contraseña"
    }
}




const validPassword = () => {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
    const password = inputPassword.value

    if (password === "") {
        Lobibox.notify('error', {
            msg: "Se requiere la contraseña"
        });
        return false
    }
    
    if (password.length <= 7) {
        Lobibox.notify('error', {
            msg: "La contraseña debe ser mayor a 7 caracteres"
        });
        return false
    }
    
    if (password.length > 16) {
        Lobibox.notify('error', {
            msg: "La contraseña debe ser menor a 16 caracteres"
        });
        return false
    }

    if (!regex.test(password)) {
        Lobibox.notify('error', {
            msg: "Contraseña inválida"
        });
        return false
    }

    return true
}

// Mostrado y ocultando la contraseña del input 0
showPasswordBtn0.addEventListener("click", () => {
    if (inputPassword0.type === "password") {
        inputPassword0.type = "text"
        eyeImage0.src = imagesData.eyeOff.url
        eyeImage0.alt = imagesData.eyeOff.alt
    } else {
        inputPassword0.type = "password"
        eyeImage0.src = imagesData.eye.url
        eyeImage0.alt = imagesData.eye.alt
    }
})


// Mostrado y ocultando la contraseña del input 1
showPasswordBtn1.addEventListener("click", () => {
    if (inputPassword1.type === "password") {
        inputPassword1.type = "text"
        eyeImage1.src = imagesData.eyeOff.url
        eyeImage1.alt = imagesData.eyeOff.alt
    } else {
        inputPassword1.type = "password"
        eyeImage1.src = imagesData.eye.url
        eyeImage1.alt = imagesData.eye.alt
    }
})

// Mostrado y ocultando la contraseña del input 2
showPasswordBtn2.addEventListener("click", () => {
    if (inputPassword2.type === "password") {
        inputPassword2.type = "text"
        eyeImage2.src = imagesData.eyeOff.url
        eyeImage2.alt = imagesData.eyeOff.alt
    } else {
        inputPassword2.type = "password"
        eyeImage2.src = imagesData.eye.url
        eyeImage2.alt = imagesData.eye.alt
    }
})



