// Ajax File upload with jQuery and XHR2
// Sean Clark http://square-bracket.com
// xhr2 file upload
$.fn.upload = function(remote, data, successFn, progressFn) {
	// if we dont have post data, move it along
	if (typeof data != "object") {
		progressFn = successFn;
		successFn = data;
	}

	var formData = new FormData();

	var numFiles = 0;
	this.each(function() {
		var i, length = this.files.length;
		numFiles += length;
		for (i = 0; i < length; i++) {
			formData.append(this.name, this.files[i]);
		}
	});

	// if we have post data too
	if (typeof data == "object") {
		for (var i in data) {
			formData.append(i, data[i]);
		}
	}

	var def = new $.Deferred();
	if (numFiles > 0) {
		// do the ajax request
		$.ajax({
			url: remote,
			type: "POST",
			xhr: function() {
				myXhr = $.ajaxSettings.xhr();
				if(myXhr.upload && progressFn){
					myXhr.upload.addEventListener("progress", function(prog) {
						var value = ~~((prog.loaded / prog.total) * 100);

						// if we passed a progress function
						if (typeof progressFn === "function") {
							progressFn(prog, value);

						// if we passed a progress element
						} else if (progressFn) {
							$(progressFn).val(value);
						}
					}, false);
				}
				return myXhr;
			},
			data: formData,
			dataType: "json",
			cache: false,
			contentType: false,
			processData: false,
			complete: function(res) {
				var json;
				try {
					json = JSON.parse(res.responseText);
				} catch(e) {
					json = res.responseText;
				}
				if (typeof successFn === "function") successFn(json);
				def.resolve(json);
			}
		});
	} else {
		def.reject();
	}

	return def.promise();
};