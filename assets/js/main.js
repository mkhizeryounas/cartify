function datePicker(id) {
	return new Pikaday({
		    field: document.getElementById(id),
		    format: 'D/M/YYYY',
		    toString(date, format) {
		        // you should do formatting based on the passed format,
		        // but we will just return 'D/M/YYYY' for simplicity
		        const day = date.getDate();
		        const month = date.getMonth() + 1;
		        const year = date.getFullYear();
		        return `${year}-${month}-${day}`;
		    },
		    parse(dateString, format) {
		        // dateString is the result of `toString` method
		        const parts = dateString.split('/');
		        const day = parseInt(parts[0], 10);
		        const month = parseInt(parts[1] - 1, 10);
		        const year = parseInt(parts[1], 10);
		        return new Date(year, month, day);
		    }
	});
}
function newCode() {
	return voucher_codes.generate({length: 12})[0].toUpperCase();
}
function var_check(v) {
  if(typeof v !== "undefined" && v !== "" && v !== null)
    return true;
  else 
    return false;
}
function uniqid() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}
$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
			

			
		});
		$(document).ready(function() {
			
		})
		
		function mainS(){
			$('#main-status').html('<span class="alert alert-success"><i class="fa fa-check"></i> Successful</span>');
			$('#main-status').fadeToggle();
			$('#main-status').delay(1000).fadeToggle();
		}
		function mainE(){
			$('#main-status').html('<span class="alert alert-danger"><i class="fa fa-times"></i> Unsuccessful</span>');
			$('#main-status').fadeToggle();
			$('#main-status').delay(1000).fadeToggle();
		}
		function start() {
			$('#wait').fadeIn()
		}
		function end() {
			$('#wait').fadeOut()
		}
		function _error() {
			end();
			$('#error').fadeIn()
			$('#error').delay(1500).fadeOut()
		}
		function _success() {
			end();
			$('#success').fadeIn()
			$('#success').delay(1500).fadeOut()
		}

		function validateEmail(email) {
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}


function notification(type, msg) {
    // Get the snackbar DIV
    $('#sd-msg').html(msg);

	if(type == 'success')
    	$('#snackbar').prop('style', 'background-color:#7bc475'); //SUCCESS
    else if (type == 'danger')
    	$('#snackbar').prop('style', 'background-color:#ff4d4d'); //ERROR
    else 
    	$('#snackbar').prop('style', 'background-color:#444'); //ERROR

    var x = document.getElementById("snackbar")

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}