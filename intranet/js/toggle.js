const survey = document.getElementById('satisfaction-survey')
const container = document.getElementById('survey-container')
const table_details = document.getElementById('table-details');
const btnQuest = document.getElementById('btnQuest');

/* toggle */
$('#pages-toggle').click(function() {
    if ($(this).is(':checked')) {
        /* Muestra el cuestionario de preguntas */
        //  alert('checked');
        //  table_details.classList.add('hide-details')
        table_details.classList.add('hide-details')
        survey.classList.add('show-survey')
        container.classList.add('height')
    } else {
        //  alert('unchecked');
        table_details.classList.remove('hide-details')
        survey.classList.remove('show-survey')
        container.classList.remove('height')
    }
})

/* para el boton */
$('#btnQuest').click(() => {
    table_details.classList.add('hide-details')
    survey.classList.add('show-survey')
    container.classList.add('height')
    btnQuest.classList.add('hide-details')
})

$('#btnEncuesta').click(() => {
    /* $('.face-icons button').css({'scale': '1'})
    alert('asd') */
})


/* restablecer al iniciar el modal */
$('#btnDetails').click(() => {
    table_details.classList.remove('hide-details')
    survey.classList.remove('show-survey')
    container.classList.remove('height')
    btnQuest.classList.remove('hide-details')
})