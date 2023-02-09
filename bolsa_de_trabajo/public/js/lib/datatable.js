class Datatable {

    constructor(nametable) {
        this.table = nametable;
        this.URL = $('#url').val();

        this.urlPath = null;
        this.labelAmount = null;
        this.labelText = null;
        this.contentText = null;
    }

    buttons(obj, label) {
        new $.fn.dataTable.Buttons(this.table, {
            buttons: [
                obj,
            ]
        }).container().appendTo($(label));
    }

    registrationAmount(urlPath = null, labelAmount = null, labelText = null, contentText = null) {
        this.urlPath = urlPath;
        this.labelAmount = labelAmount;
        this.labelText = labelText;
        this.contentText = contentText;
        if (this.urlPath != null && this.urlPath != "") {
            $.ajax({
                url: this.URL + urlPath,
                type: "POST",
                data: {
                    accion: 'getAmount',
                },
                success: function (response) {
                    let $reply = JSON.parse(response)
                    $(labelAmount).html($reply['Amount']);
                    $reply['Amount'] == 1 ? $(labelText).html(contentText.substring(0, contentText.length - 1)) : $(labelText).html(contentText)
                }
            });
        } else {
            $(this.labelAmount).html("?");
        }
    }

    inputSearch(label) {
        $(label).on('keyup', () => {
            this.table.search($(label).val()).draw();
        });
    }

}


export { Datatable };