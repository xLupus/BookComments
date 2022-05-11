function readImage() {

    if (this.files && this.files[0]) {
        let file = new FileReader();

        file.onload = function(e) {
            let img = document.getElementById("img-preview")
            img.src = e.target.result;
            img.style.width = '270px';
            img.style.height = '360px';
        };    

        file.readAsDataURL(this.files[0]);
    }

}

document.getElementById("img-input").addEventListener("change", readImage, false);