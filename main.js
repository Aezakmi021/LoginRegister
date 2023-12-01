const signUp = document.getElementById('signup');
const signIn = document.getElementById('signin');
const container = document.querySelector('.container');
const login = document.getElementById('login');

signUp.addEventListener('click', () => {
    container.classList.add('active');
});

signIn.addEventListener('click',  () => {
    container.classList.remove('active');
});

login.addEventListener('click', () => {
    
});



