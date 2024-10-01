let captcha;
function generate() {
  // Clear old input
  $('#captcha').val('');

  // Access the element to store
  // the generated captcha
  captcha = $('#image');
  let uniquechar = '';

  const randomchar = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

  // Generate captcha for length of
  // 5 with random character
  for (let i = 1; i < 5; i++) {
    uniquechar += randomchar.charAt(Math.random() * randomchar.length);
  }

  // Store generated input
  captcha.html(uniquechar);
}

function printmsg() {
  const usr_input = $('#captcha').val();

  // Check whether the input is equal
  // to generated captcha or not
  if (usr_input == captcha.innerHTML) {
    let s = ($('#key').innerHTML = 'Matched');
    generate();
  } else {
    let s = ($('#key').innerHTML = 'not Matched');
    generate();
  }
}

$(document).ready(function() {
  generate();
});
