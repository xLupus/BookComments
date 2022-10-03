let alturaWindow = window.screen.height
let alturaBody   = document.body.clientHeight
let footer       = document.querySelector('footer')

if(alturaBody <= alturaWindow){
    footer.style.position = 'absolute'
    footer.style.bottom   = '0'
    footer.style.zIndex   = 0
}
