window.jsPDF = window.jspdf.jsPDF;
const _URL_ = document.querySelector("#url").value;
const DateTime = luxon.DateTime;
DateTime.now().setZone('America/Lima')
class PDF {
    __contruct() {
    }
    generarPDFEmpleo(data) {
        let doc = new jsPDF();
        let widthPage = doc.internal.pageSize.getWidth();
        let heightPage = doc.internal.pageSize.getHeight();

        // Datos Empresa --> HEADER
        doc.setFillColor(10, 26, 48);
        doc.rect(0, 0, widthPage, 35, 'FD'); // filled square with red borders
        doc.addImage(_URL_ + "public/image/encap_blanco.png", "png", 10, 5, 21, 19);
        doc.setTextColor(255, 255, 255);
        doc.setFontSize(11);
        doc.text("ESCUELA NACIONAL DE CAPACITACIÓN Y ACTUALIZACIÓN PROFESIONAL", ((widthPage / 2) / 3) + 5, 18);

        // Datos body
        doc.autoTable({
            columns: [{ title: data["nombre"], dataKey: "id" }],
            body: [{ "id": data["empresa"] }],
            theme: 'plain',
            margin: { left: 10, right: 2, top: 45 },
            tableWidth: widthPage - 25,
            styles: { lineWidth: 0, lineColor: "gray", halign: "center", valign: "middle", margin: "0,0,0,0" },
            bodyStyles: { fillColor: "#ffffff", fontSize: 11 },
            headStyles: { fontSize: 12, textColor: "#034bb8" },
        });

        doc.setTextColor(69, 70, 71);
        doc.setFont('arial', "bold");
        doc.setFontSize(13);
        doc.text("Requerimientos", 10, 80);

        // Experiencia
        doc.autoTable({
            columns: [{ title: "EXPERIENCIA", dataKey: "id" }],
            body: [{ "id": data["experiencia"] }],
            theme: 'plain',
            showHead: 'firstPage',
            startY: 95,
            margin: { left: 10, right: 2, top: 120 },
            tableWidth: widthPage - 25,
            styles: { lineWidth: 0, lineColor: "gray", halign: "left", valign: "middle", margin: "0,0,0,0" },
            bodyStyles: { fillColor: "#ffffff", fontSize: 10, textColor: "#454647" },
            headStyles: { fontSize: 11, textColor: "#034bb8" },
        });

        // Formación Académica
        doc.autoTable({
            columns: [{ title: "FORMACIÓN ACADÉMICA - PERFIL:", dataKey: "id" }],
            body: [{ "id": data["formacion"] }],
            theme: 'plain',
            showHead: 'firstPage',
            margin: { left: 10, right: 2 },
            tableWidth: widthPage - 25,
            styles: { lineWidth: 0, lineColor: "gray", halign: "left", valign: "middle", margin: "0,0,0,0" },
            bodyStyles: { fillColor: "#ffffff", fontSize: 10, textColor: "#454647" },
            headStyles: { fontSize: 11, textColor: "#034bb8" },
        });

        // Especiaización
        doc.autoTable({
            columns: [{ title: "ESPECIALIZACIÓN:", dataKey: "id" }],
            body: [{ "id": data["especializacion"] }],
            theme: 'plain',
            showHead: 'firstPage',
            margin: { left: 10, right: 2 },
            tableWidth: widthPage - 25,
            styles: { lineWidth: 0, lineColor: "gray", halign: "left", valign: "middle", margin: "0,0,0,0" },
            bodyStyles: { fillColor: "#ffffff", fontSize: 10, textColor: "#454647" },
            headStyles: { fontSize: 11, textColor: "#034bb8" },
        });

        // Conocimiento
        doc.autoTable({
            columns: [{ title: "CONOCIMIENTO:", dataKey: "id" }],
            body: data["conocimiento"].split(",").map((e, i) => {
                return { "id": `${(i + 1)}. ${e}` }
            }),
            theme: 'plain',
            showHead: 'firstPage',
            margin: { left: 10, right: 2 },
            tableWidth: widthPage - 25,
            styles: { lineWidth: 0, lineColor: "gray", halign: "left", valign: "middle", margin: "0,0,0,0" },
            bodyStyles: { fillColor: "#ffffff", fontSize: 10, textColor: "#454647" },
            headStyles: { fontSize: 11, textColor: "#034bb8" },
        });

        // Competencias
        doc.autoTable({
            columns: [{ title: "COMPETENCIAS:", dataKey: "id" }],
            body: data["competencia"].split(",").map((e, i) => {
                return { "id": `${(i + 1)}. ${e}` }
            }),
            theme: 'plain',
            showHead: 'firstPage',
            margin: { left: 10, right: 2 },
            tableWidth: widthPage - 25,
            styles: { lineWidth: 0, lineColor: "gray", halign: "left", valign: "middle", margin: "0,0,0,0" },
            bodyStyles: { fillColor: "#ffffff", fontSize: 10, textColor: "#454647" },
            headStyles: { fontSize: 11, textColor: "#034bb8" },
        });

        // Detalle
        doc.autoTable({
            columns: [{ title: "Detalle:", dataKey: "id" }],
            body: [
                { "id": "Ubicado en " + data["ubicacion"] },
                { "id": (data["nvacantes"] == 1) ? data["nvacantes"] + " vacante disponible" : data["nvacantes"] + " vacantes disponibles" },
                { "id": "Sueldo de S/ " + data["renumeracion"] + " Soles" },
                { "id": "Publicado el " + data["fechainicio"] },
                { "id": "Vigente hasta el " + data["fechafin"] },
            ],
            theme: 'plain',
            showHead: 'firstPage',
            margin: { left: 10, right: 2 },
            tableWidth: widthPage - 25,
            styles: { lineWidth: 0, lineColor: "gray", halign: "left", valign: "middle" },
            bodyStyles: { fillColor: "#ffffff", fontSize: 10, textColor: "#454647" },
            headStyles: { fontSize: 12, textColor: "#454647" },
        });

        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 0; i <= pageCount; i++) {
            doc.setPage(i);
            // Datos Empresa --> Footer
            doc.setFillColor(10, 26, 48);
            doc.rect(0, heightPage - 13, widthPage, 20, 'FD');
            doc.setTextColor(255, 255, 255);
            doc.setFontSize(11);
            doc.text("Web: www.encap.edu.pe", 13, heightPage - 5);
            doc.text("Contáctanos: 951 428 884 / 930 627 791", 100, heightPage - 5);
        }
        doc.output('save', 'Empleo.pdf');
    }
}

export { PDF }