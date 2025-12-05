<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $team->name }} Line Up</title>

    <style>
        body {
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 15px;
        }

        .full-width {
            width: 100%;
        }

        .section-spacing {
            margin-bottom: 15px;
        }

        .pdf-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pdf-table th,
        .pdf-table td {
            border: 1px solid #000;
            padding: 4px 6px;
        }

        .divider {
            width: 100%;
            border-bottom: 1px solid #000;
            margin: 15px 0;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <table class="full-width no-border section-spacing">
        <tr>
            <td style="text-align: left; width: 33%;">
                &nbsp;
            </td>

            <td style="text-align: center; width: 34%;">
                <div style="font-size: 1.25rem;"><strong>{{ $tournament->name ?? '' }}</strong></div>
                <div style="font-size: 0.75rem;">
                    {{ $tournament->start_date ? \Carbon\Carbon::parse($tournament->start_date)->format('d/m/Y') : '' }} 
                    - 
                    {{ $tournament->end_date ? \Carbon\Carbon::parse($tournament->end_date)->format('d/m/Y') : '' }}
                </div>
                <div style="font-size: 1rem;">{{ $tournament->venue->name ?? '' }}</div>
            </td>

            <td style="text-align: right; width: 33%;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/teamAlogo.png'))) }}"
                    width="100">
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- TITLE -->
    <div style="text-align:center; margin: 20px 0;">
        <h4 style="margin:0; padding:0; font-size: 1.1rem;">Team Line Up</h4>
        <h5 style="margin:0; padding:0; font-size: 1rem;">{{ $team->name }}</h5>
    </div>

    <!-- ROW 2 -->
    <table class="full-width no-border section-spacing">
        <tr>
            <!-- MATCH INFO -->
            <td style="width:60%; vertical-align: top; padding-right: 10px;">
                <table class="pdf-table">
                    <thead>
                        <tr><th colspan="2" style="text-align:center;">Match Information</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 40%; text-align: center;">Match</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width: 40%; text-align: center;">Detail</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width: 40%; text-align: center;">Date</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width: 40%; text-align: center;">Pitch</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </td>

            <!-- TEAM COLOURS -->
            <td style="width:40%; vertical-align: top;">
                <table class="pdf-table">
                    <thead>
                        <tr>
                            <th style="text-align:center; width: 40%;">Team Colours </th>
                            <th style="text-align:center; width: 60%;"> {{ $team->name }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Shirts</td><td>&nbsp;</td></tr>
                        <tr><td>Shorts</td><td>&nbsp;</td></tr>
                        <tr><td>Socks</td><td>&nbsp;</td></tr>
                        <tr><td>GK Shirt</td><td>&nbsp;</td></tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <!-- PLAYER LINE UP -->
    <table class="full-width no-border section-spacing">
        <tr>
            <td style="width:60%; vertical-align: top; padding-right: 10px;">

                <table class="pdf-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Starting</th>
                            <th>Shirt #</th>
                            <th>Name</th>
                        </tr>
                    </thead>

                    <tbody>
                        @for ($i = 1; $i <= 18; $i++)
                            <tr>
                                <td style="text-align: center; width: 5%;">{{ $i }}</td>
                                <td style="width: 10%;">&nbsp;</td>
                                <td style="width: 15%; text-align: center;">{{ $players[$i - 1]->jerseyNumber ?? "" }}</td>
                                <td style="width: 70%;"> {{ $players[$i - 1]->name ?? "" }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

            </td>

            <td style="vertical-align: top;">

                <div><strong>Instructions:</strong></div>

                <div>Please designate Captain (C).</div>
                <div>Please designate Goalkeeper (GK).</div>

                <div style="margin-top:10px;">
                    Match Players: maximum of 18<br>
                    Starting Lineup: maximum of 11
                </div>

                <div style="margin-top:40px;">
                    
                    ______________________
<br>
                    <strong>Manager Signature:</strong><br><br>
                </div>

                <div>
                    @php
                        $logoPath =  $team->LogoURL;

                        // dd($logoPath);
                        if ($logoPath == 'img/teamAlogo.png') {
                            $display = false;
                        } else {
                            $display = true;
                        }
                        // dd($logoPath);
                    @endphp
                    <div style="text-align: center; margin-top: 50px;">
                        @if(!empty($team->LogoURL) && $team->LogoURL != 'img/teamAlogo.png')
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($team->LogoURL))) }}" 
                                width="200" alt="Team Logo">
                        @endif
                    </div>


                </div>

            </td>
        </tr>
    </table>

    


    <!-- CONTENT -->
    <div class="divider" style="position: fixed; bottom: 25px; border-bottom:1px solid #000; margin: 10px 0;"></div>

    <!-- FOOTER -->
    <table class="full-width no-border" style="position: fixed; bottom: 25px; width: 100%;">
        <tr>
            <td style="text-align:left;">Copyright © 2025 JiwaHockey</td>
            <td style="text-align:right;">Page 1 of 1</td>
        </tr>
    </table>



</body>
</html>
