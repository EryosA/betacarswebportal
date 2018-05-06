Dropzone.options.uploads = {
	maxFilesize: 2,
	acceptedFiles: ".jpg, .jpeg, .png, .pdf",
	
	success:function (file, response) {
		if(file.status === 'success') {
			handleResponse.handleSuccess(response);
		}else{
			handleResponse.handleError(response);
		}
	}
};

var handleResponse = {
	
	handleError: function (response) {
			console.log(response);
	},
	handleSuccess: function (response) {
		alert("File Uploaded!");
		window.location.href = "https://betacars-webportal.000webhostapp.com/drivereditdocu.php";
	}
};