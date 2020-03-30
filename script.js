const toggleinputs = document.querySelectorAll(".toggleSwitch");

toggleinputs.forEach(toggle => {
  toggle.addEventListener("change", sendForm);
});

function sendForm(e) {
  //e.currentTarget.form.submit()
  //console.log(this.form);
  this.form.submit();
}

$(document).ready(function() {
  $(".deleteForm").submit(function() {
    if (confirm("Are you sure you want to delete this post?")) {
      return true;
    } else {
      return false;
    }
  });
});

/* const deleteForms = document.querySelectorAll('.deleteForm');
deleteForms.forEach(form => {
  form.addEventListener('submit', deleteCheck);
});

function deleteCheck(e) {
  e.preventDefault();
  if (confirm('Are you sure you want to delete this post')) {
    console.log(this);
    console.log(e);

    this.form.submit();
  }
  return

} */
