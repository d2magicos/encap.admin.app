//Class Toast
class Toast {

    constructor() {
        this.animation = ['fade', 'slide', 'plain'];
        this.icons = ['info', 'warning', 'error', 'success'];
    }
    show($title, $description, $animation, $icons) {
        if (this.animation.includes($animation) && this.icons.includes($icons)) {
            $.toast({
                heading: $title,
                text: $description,
                icon: $icons,
                showHideTransition: $animation,
                position: 'top-right',
                allowToastClose: 'true',
                hideAfter: 5000,
                loaderBg: '#9EC600',
            })
        } else {
            $.toast({
                heading: 'ERROR',
                text: 'Algo salio mal',
                showHideTransition: 'slide',
                icon: 'error'
            })
        }
    }
}


export { Toast };