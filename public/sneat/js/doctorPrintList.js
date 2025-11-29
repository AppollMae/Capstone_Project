document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("printBtn").addEventListener("click", function () {
        let originalTable = document
            .getElementById("doctorsList")
            .cloneNode(true);

        // Get the image URL from the hidden image elements
        let slsuLogoSrc = document.getElementById("slsuLogo").src;
        let bagongPilipinasLogoSrc = document.getElementById(
            "bagongPilipinasLogo"
        ).src;
        let footerLogoSrc1 = document.getElementById("picture1FooterLogo").src;
        let picture2FooterLogo =
            document.getElementById("picture2FooterLogo").src;

        let printContents = originalTable.outerHTML;

        let newWindow = window.open("_blank");
        newWindow.document.write(`
        <html>
        <head>
            <title></title>
            <style>
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
                .header .text p {
                    margin: 5px 0;
                    font-size: 14px;
                }
                .header .text p span {
                    font-weight: bold !important;
                }
                h2 {
                    margin-top: 10px;
                    margin-bottom: 20px;
                    font-size: 22px;
                }
                table { 
                    width: 100%; 
                    border-collapse: collapse; 
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
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
                .footer {
                    position: absolute;
                    bottom: 20px;
                    right: 20px;
                    display: flex;
                    align-items: center;
                }
                .footer-container {
                    display: flex;
                    align-items: center;
                    gap: 10px;
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
            <h2>Doctor List</h2>
            ${printContents}
            <div class="footer">
                <div class="footer-container">
                    <img src="${footerLogoSrc1}" alt="QS Stars Rating System Logo">
                    <img src="${picture2FooterLogo}" alt="ISO 9001:2015 Socotec Logo">
                </div>
            </div>
            <script>
                window.onload = function() {
                    window.print();
                    window.onafterprint = function() { window.close(); };
                };
            <\/script>
        </body>
        </html>
    `);
        newWindow.document.close();
    });
});
