let width = window.matchMedia("(max-width: 512px)")

buttonOnResponsive = (x) => {
    if (x.matches) {
        let link = "#tracking-container"
        let buttons = document.getElementsByClassName("btn-estadoEnvio")

        for(let i = 0; i < buttons.length; i++) {
            //  buttons[i].classList.add("")
            buttons[i].setAttribute('href', link)
        }
    }
}

init()

//  buttonOnResponsive(width)
//  width.addListener(buttonOnResponsive)
