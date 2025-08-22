document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("printBtn").addEventListener("click", function () {
        let originalTable = document
            .getElementById("appointmentsTable")
            .cloneNode(true);

        // Remove the "Actions" column from table headers
        let headers = originalTable.querySelectorAll("thead th");
        if (headers.length > 0) {
            headers[headers.length - 1].remove(); // Remove last column (Actions)
        }

        // Remove the "Actions" column from table rows
        let rows = originalTable.querySelectorAll("tbody tr");
        rows.forEach((row) => {
            let cells = row.querySelectorAll("td");
            if (cells.length > 0) {
                cells[cells.length - 1].remove(); // Remove last column (Actions)
            }
        });

        let printContents = originalTable.outerHTML;

        // Get the image URL from the hidden image elements
        let slsuLogoSrc = document.getElementById("slsuLogo").src;
        let bagongPilipinasLogoSrc = document.getElementById(
            "bagongPilipinasLogo"
        ).src;
        let footerLogoSrc1 = document.getElementById("picture1FooterLogo").src;
        let picture2FooterLogo =
            document.getElementById("picture2FooterLogo").src;

        let newWindow = window.open("_blank");
        newWindow.document.write(`
        <html>
        <head>
            <title></title>
            <style>
                @media print {
        thead { display: table-header-group; }
        tfoot { display: table-footer-group; }
        .footer {
            display: block;
            margin-top: 30px;
            text-align: right;
            page-break-after: always;
        }
        .footer-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
    }

    body { 
        font-family: Arial, sans-serif; 
        padding: 20px;
        text-align: center;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 2px solid black;
        padding-bottom: 10px;
        width: 100%;
    }
    .header img {
        max-width: 100px;
    }
    .header .text {
        flex-grow: 1;
        text-align: center;
        width: 100%;
    }
    h2 {
        margin-top: 10px;
        margin-bottom: 20px;
        font-size: 22px;
    }
    table { 
        width: 100%; 
        border-collapse: collapse; 
        background-color: #fff;
    }
    th, td { 
        border: 1px solid #ddd; 
        padding: 12px; 
        text-align: center;
    }
    th { 
        background-color: #007bff; 
        color: white; 
        font-weight: bold;
    }
    tr:nth-child(even) { 
        background-color: #f2f2f2;
    }
    img { 
        max-width: 75px; 
        max-height: 75px; 
        border-radius: 5px;
    }
    .footer img {
        max-width: 120px;
        height: auto;
    }
            </style>
        </head>
        <body>
            <div class="header">
                <img src="${slsuLogoSrc}" alt="SLSU Logo">
                <div class="text">
                    <h2>Southern Leyte State University</h2>
                    <p><span>Email:</span> odi@southernleytestateu.edu.ph</p>
                    <p><span>Website:</span> www.southernleytestateu.edu.ph</p>
                    <p>Excellence | Service | Leadership and Good Governance | Innovation | Social Responsibility | Integrity | Professionalism | Spirituality</p>
                </div>
                <img src="${bagongPilipinasLogoSrc}" alt="Bagong Pilipinas">
            </div>
            <h2>Appointments Reports</h2>
            ${printContents}
<tfoot class="footer">
    <tr>
        <td colspan="100%">
            <div class="footer-container">
                <img src="${footerLogoSrc1}" alt="QS Stars Rating System Logo">
                <img src="${picture2FooterLogo}" alt="ISO 9001:2015 Socotec Logo">
            </div>
        </td>
    </tr>
</tfoot>
            <script>
                window.onload = function() {
                    window.print();
                    window.onafterprint = function() { window.close(); };
                };
            </script>
        </body>
        </html>
    `);
        newWindow.document.close();
    });
});
