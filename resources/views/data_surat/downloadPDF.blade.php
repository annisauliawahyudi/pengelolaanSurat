<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Resmi</title>
    <style>
          @page {
            size: A4;
            margin: 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 2cm; /* Set margin 2cm sesuai ukuran kertas A4 */
            line-height: 1.6;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .logo {
            width: 100px;
            height: 100px;
        }

        .address {
            text-align: left;
        }

        .address p {
            margin: 0;
        }

        .date-no {
            text-align: right;
        }

        .date-no p {
            margin: 5px 0;
        }

        .recipient-info {
            text-align: left;
            margin-bottom: 30px;
        }

        .subject {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .body-text {
            text-align: justify;
            margin-bottom: 20px;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .details-right {
            
            width: 60%;
            text-align: left;
        }

        .closing {
            text-align: left;
            margin-top: 50px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature .signature-box {
            display: inline-block;
            border-bottom: 1px solid black;
            width: 150px;
            text-align: center;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }

        .body-text1 {
            text-align: left;
            /* width: 60%; */
            /* margin-right: 1%; */
        }

        .body-text-container {
            display: flex;
            justify-content: space-between;
        }

        .signature-line {
        border-bottom: 1px solid black;
        width: 10%; /* Atur panjang garis sesuai kebutuhan */
        margin-top: 20px;
    }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="path/to/your/logo.png" alt="Your Logo" style="width: 100%; height: 100%;">
        </div>
        <div class="address">
            <p><b>SMK WIKRAMA BOGOR</b></p>
            <hr>
            <p>Bisnis dan Menejmen</p>
            <p>Teknologi Informasi dan Komunikasi</p>
            <p>Pariwisata</p>
        </div>
        <div class="date-no">
            <p>Jl. Raya Wangun Kel. Sindangsari Bogor</p>
            <p>Telp/Faks: (0251) 8242411</p>
            <p>e-mail: prohumasi@smkwikrama.sch.iid</p>
            <p>website: www.smkwikrama.sch.id</p>
        </div>
    </div>
    <div class="body-text-container">
        <div class="body-text">
            <p>No: 220604-1/0002/SMK Wikrama/XII/2023</p>
            <p>Hal: <b>Pengayaan</b></p>
        </div>
        <div class="body-text1">
            <p>25 Desember 2023</p>
            <p>kepada</p>
            <p>Yth. Bapa/Ibu Terlampir <br>di <br>Tempat</p>
        </div>
    </div>

    <div class="details">
        <div class="details-right">
            <p>Dengan hormat,</p>
            <p>Bersama ini kami mengundang Bapak/Ibu untuk mengikuti rapat yang akan dilaksanakan pada:</p>
            <p>Hari, Tanggal    : Rabu, 30 Desember 2023</p>
            <p>Pukul    : 14.00 WIB s.d. Selesai</p>
            <p>Tempat   : Ruang Kepala Sekolah</p>
            <p>Agenda   : Pra PKL</p>
            <p>Notulis  : Nisa</p>
            <p>Demikian undangan ini kami sampaikan, atas perhatian dan kerja sama Bapak/Ibu kami ucapkan terima kasih.</p>
        </div>
    </div>

    <div class="closing">
        <p>hormat kami,</p>
        <p>Kepala SMK Wikrama Bogor</p>
        <br><br>
         <div class="signature-line"></div>
    </div>

   
