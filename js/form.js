let forms = document.getElementById('forms');
let form1 = document.getElementById('form1');
let form2 = document.getElementById('form2');
let image = document.getElementById('image');
let varButton = document.getElementById('varButton');
let header = document.querySelector('h1 span');
let paragraph = document.querySelector('p span');

varButton.addEventListener('click', function(){

 if (form2.style.display === 'none')
{
    form1.style.display = 'none';
    form2.style.display = 'block';
    varButton.innerHTML = 'Sgin-up';
    header.innerHTML = "Welcome back!";
    paragraph.innerHTML = "To keep connected with us please<br>login with your personal info";
}
else{
    form2.style.display = 'none';
    form1.style.display = 'block';
    varButton.innerHTML = 'Sgin-in';
    header.innerHTML = "Create account";
    paragraph.innerHTML = "To keep connected with us please<br>login with your personal info";
}
})


