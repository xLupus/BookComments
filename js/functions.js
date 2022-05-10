let eyeIcon = document.getElementsByClassName('fa-solid')

eyeIcon[0].addEventListener('click', function(event){

    let senha = event.target.parentElement.children[1]
    let icon = event.target

    if(senha.type == 'password'){
        senha.type = 'text'
        icon.className = 'fa-solid fa-eye'

    }else{
        senha.type = 'password'
        icon.className = 'fa-solid fa-eye-slash'
    }
})
