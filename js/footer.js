let alturaWindow = window.screen.height
let alturaBody = document.body.clientHeight
let footer = document.querySelector('footer')

if(alturaBody <= alturaWindow){
    footer.style.position = 'absolute'
    footer.style.bottom = '0'
}

console.log(footer)
console.log(alturaWindow)
console.log(alturaBody)
