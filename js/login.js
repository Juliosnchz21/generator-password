$(document).ready(function() {
// Verificar si hay un email guardado en localStorage
var rememberedEmail = localStorage.getItem('rememberedEmail');
if (rememberedEmail) {
	$('#email').val(rememberedEmail);
	$('#remember').prop('checked', true); // Marcar el checkbox "Remember Me"
}

// Elementos del DOM
const navEl = document.querySelector('.nav');
const hamburgerEl = document.querySelector('.hamburger');
const modalLogin = document.getElementById("modalLogin");
const modalContainer = document.querySelector(".modal-container");
const closeModalButton = document.getElementById("closeModal");
const Create = document.getElementById("Create");
const Reset = document.getElementById("Reset");
const loginHere = document.getElementById("loginHere");
const loginForm = document.querySelector(".login");
const resetForm = document.querySelector(".reset-password");
const registrationForm = document.querySelector(".registration");


// Manejo de la hamburguesa del menú
    hamburgerEl.addEventListener('click', () => {
        navEl.classList.toggle('nav--open');
        hamburgerEl.classList.toggle('hamburger--open');
    });

    // Abrir el modal y mostrar el formulario de login por defecto
    modalLogin.addEventListener('click', () => {
        modalContainer.classList.add("open");
        showForm('login');
    });

    // Cerrar el modal
    closeModalButton.addEventListener('click', () => {
        closeModalContainer();
    });

    function closeModalContainer() {
        modalContainer.classList.remove("open");
        resetModalState();
    }

    function resetModalState() {
        loginForm.style.display = "none";
        registrationForm.style.display = "none";
        resetForm.style.display = "none";
    }

    function showForm(formType) {
        resetModalState();
        if (formType === 'login') {
            loginForm.style.display = "block";
        } else if (formType === 'registration') {
            registrationForm.style.display = "block";
        } else if (formType === 'reset') {
            resetForm.style.display = "block";
        }
    }

    Create.addEventListener('click', () => {
        showForm('registration');
    });

	// Eventos para cambiar entre formularios
	Reset.addEventListener('click', () => {
		showForm('reset');
	});

    loginHere.addEventListener('click', () => {
        showForm('login');
    });

function login(){
	//ajax
	var datos=new FormData($('#formLogin')[0]);
	datos.append("action","login");
	$.ajax(
		{
		url: './controlador/controladorLogin.php',
		method: 'POST',
		timeout: 10000,
		data: datos,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function(data){
			if (data.codErr != 0) {
				$("#loginResp").html(data.msgErr);
			} else {
				if ($('#remember').is(':checked')) {
                    // Guardar el email en localStorage
                    localStorage.setItem('rememberedEmail', $('#email').val());
                } else {
                    // Limpiar la memoria del email guardado
                    localStorage.removeItem('rememberedEmail');
                }
				location.href = "./principal.php";
			}
		},
		complete: function() {
            // Limpiar el formulario después de completar la solicitud
            $('#formLogin')[0].reset();
        }
	});
}

function registro(){
	if (!document.getElementById('terms').checked) {
        $("#registerResp").html("Please accept Terms & Conditions.");
        return; // Detener el registro si no se aceptan los términos
    }
	//ajax
	var datos=new FormData($('#formRegistro')[0]);
	datos.append("action","registro");
	$.ajax(
		{
		url: './controlador/controladorLogin.php',
		method: 'POST',
		timeout: 10000,
		data: datos,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function(data){
			if (data.codErr != 0) {
                    $("#registerResp").html(data.msgErr);
                } else {
                    $("#registerResp").html(data.msg);
                }
		},
		complete: function() {
            // Limpiar el formulario después de completar la solicitud
            $('#formRegistro')[0].reset();
        }
	});
}

function reestablecer(){
	//ajax
	var datos=new FormData($('#formReestablecer')[0]);
	datos.append("action","reestablecer");
	$.ajax(
		{
		url: './controlador/controladorLogin.php',
		method: 'POST',
		timeout: 10000,
		data: datos,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function(data){
			if (data.codErr!=0){
				$("#restablecerResp").html(data.msgErr);
			} else {
				$("#restablecerResp").html(data.msg);
				
			}
		}
	});
}

function resetea(){
	//ajax
	var datos=new FormData($('#formReestablecer')[0]);
	datos.append("action","resetea");
	$.ajax(
		{
		url: './controlador/controladorLogin.php',
		method: 'POST',
		timeout: 10000,
		data: datos,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function(data){
			console.log(data);
			if (data.codErr!=0){
				$("#resp").html(data.msgErr);
			} else {
				$("#resp").html(data.msg);
				$("#btlogin").css("display","block");
				$("#resbutton").css("display","none");
			}
		},
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX error: ', textStatus, errorThrown);
		}
	});
}
window.login = login;
window.registro = registro;
window.reestablecer = reestablecer;
window.resetea = resetea;
});

