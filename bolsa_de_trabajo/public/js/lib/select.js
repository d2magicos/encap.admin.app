
class Select {

    constructor() {
        this.url = null;
        this.select = null;
        this.type_select = null;
        this.selectTag = null;
        this.parentSelectTag = null;
        this.baseUrl = null;
    }

    language() {
        const obj = {
            noResults: function () {

                return "No se encontraron resultado";
            },
            searching: function () {

                return "Buscando..";
            }
        };
        return obj;
    }

    createSelect(selectTag = null, parentSelectTag = null) {
        this.selectTag = selectTag;
        this.parentSelectTag = parentSelectTag;

        $(this.selectTag).select2({
            language: this.language(),
            width:"100%",
            dropdownParent: $(this.parentSelectTag),
            dropdownAutoWidth : true,
        });
    }

    createSelectIconsImage(selectTag = null, parentSelectTag = null, urlImage = null) {
        this.baseUrl = $("#url").val() + urlImage;
        $(selectTag).select2({
            dropdownParent: $(parentSelectTag),
            allowClear: true,
            templateResult: this.formatState,
            templateSelection: this.formatselection
        });
    }
    
    formatState(state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span><img src="' + this.baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" style="width:15px;height:15px"/> ' + state.text + '</span>'
        );
        $state.find("span").text(state.text);
        $state.find("img").attr("src", this.baseUrl + "/" + state.element.value.toLowerCase() + ".png");
        return $state;
    };

    formatselection(state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span><img class="img-flag" style="width:15px;height:15px;margin-bottom:5px;"/> <span></span></span>'
        );

        // Use .text() instead of HTML string concatenation to avoid script injection issues
        $state.find("span").text(state.text);
        $state.find("img").attr("src", baseUrl + "/" + state.element.value.toLowerCase() + ".png");

        return $state;
    };

    getData(url, type_select, select) {
        this.url = url;
        this.type_select = type_select;
        this.select = select;

        $.ajax({
            type: "POST",
            url: $("#url").val() + this.url,
            data: {
                select: type_select,
            },
            success: function (response) {
                var reply = JSON.parse(response);
                switch (type_select) {
                    case "select_ubigeo":
                        $.each(reply, function (indice, elemento) {
                            let ubi = elemento['ubigeo'] + " | " + elemento['departamento'] + " | " + elemento['provincia'] + " | " + elemento['distrito'];
                            $(select).append("<option " + "value='" + elemento['ubigeo'] + "'>" + ubi + "</option>");
                        });
                        break;
                    case "select_establecimiento":
                        $.each(reply, function (indice, elemento) {
                            let empresa = elemento['ruc'] + " | " + elemento['nombre'];
                            $(select).append("<option " + "value='" + elemento['id_establecimiento'] + "'>" + empresa + "</option>");
                        });
                        break;
                    case "select_area":
                        $.each(reply, function (indice, elemento) {
                            let area = elemento['nombre'] + " | " + elemento['numero'];
                            $(select).append("<option " + "value='" + elemento['id_area'] + "'>" + area + "</option>");
                        });
                        break;
                    case "select_tipoPersonal":
                        $.each(reply, function (indice, elemento) {
                            let tipoPersonal = elemento['descripcion'] + " | " + "S/ "+elemento['sueldo_b'];
                            $(select).append("<option " + "value='" + elemento['id_tipo_personal'] + "'>" + tipoPersonal + "</option>");
                        });
                        break;
                    default:
                        break;
                }
            }
        });
    }
}

export { Select };